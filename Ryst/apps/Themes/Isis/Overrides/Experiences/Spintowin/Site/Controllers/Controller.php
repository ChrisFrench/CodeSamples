<?php 

class ControllerOverride extends \Experiences\Spintowin\Site\Controllers\Controller 
{   
  	 	      
  function launch($tag, $event, $experience) {

        if(empty($tag)) {
              echo 'This band has no wristband tag in the tags collection'. "\n";
              return;
        }
        
       
        $attendee = null;
        $f3 = \Base::instance();
        if(!empty($tag->{'attendee.id'})) {
          $attendees = new \Dash\Site\Models\Event\Attendees;
          $attendees->setState('filter.id', $tag->{'attendee.id'});
          $attendee = $attendees->getItem();
        }
        
        if(!$attendee) {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
            $data = array('tag' => (array) $tag->cast());
            $pusher->trigger($experience->{'pusher.channel'}, 'noAttendee', $data);
        }
        
         
        $game = $this->gamePlay($attendee);
        //checking that an attendee played this game
        $spins = $attendee->spins;
        if(empty( $spins)) {
           $spins = array();
        } 

        $date = new \DateTime();
        $date->setTimezone(new \DateTimeZone($event->event_time_zone));
        $spins[] = array('time' => $date->format('Y-m-d H:i:s'), 'station' => $experience->name, 'game' => $game );
        $attendee->set('spins',$spins);
        $attendee->save();

        //trigger External Screen
//        if(@$experience->displays)  {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
            $data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->pusherPush(), 'game' => $game);
            $pusher->trigger($experience->{'pusher.channel'}, 'play', $data);
  //      }

        if(@$experience->userdevice)  {
        // trigger phone 
        $pusher = new \Pusher($f3->get('pusher_key'), $f3->get('pusher_secret'), $f3->get('pusher_app_id'));
        $data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->push(), 'content' => '/content/car' );
        $pusher->trigger($tag->tagid, 'content', $data);
        }
  }
  
    protected function gamePlay($attendee) {
      $f3 = \Base::instance();
        //if for whatever reason this preson can not win a prize
        if($attendee->noprizes) {
          return $array = array('status' => 'loser', 'prize' => array());
        }

        //lots check prize pool if we should return a winner
        $prizes = new \Dash\Site\Models\Event\Prizes;
        // WINbytime is less or equal to now
        $date = new DateTime(); echo $date->format('Y/m/d H:i');
     
        //2014/05/09 14:00
        $prizes->setParam('sort', array('_id' => -1));
        $prizes->setCondition('winbytime', array('$lte' => $date->format('Y/m/d H:i')) );
        $prizes->setCondition('winner', array('$type' => 10) );
        $prizes->setCondition('event.id', new \MongoId((string) $attendee->{'event.id'}) );
        $prize = $prizes->getItem();
        
        if(!empty($prize->id)) {
          $prize->set('winner.id',$attendee->id);
          $prize->set('winner.name',$attendee->first_name . ' '. $attendee->last_name);
          $prize->save();
          $tempprizes = $attendee->prizes;
          $tempprizes[] = array('id' => $prize->id, $prize->name);
          $attendee->prizes = $tempprizes;
          $attendee->noprizes = 'true';
          $attendee->save();
          
            \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'Experiences/Spintowin/Site/Views/', 'Experiences/Spintowin/Site/Views' );
          switch ($prize->type) {
            case 'samsung':
	$f3->set('attendee', $attendee);
          $f3->set('random', rand());
          $html = \Dsc\System::instance()->get( 'theme' )->render( 'Experiences/Spintowin/Site/Views::emails/samsung_attendee.php' );
          \Dsc\System::instance()->get('mailer')->send($attendee->email, 'Winner! Samsung Prize', array($html) );

          $html = \Dsc\System::instance()->get( 'theme' )->render( 'Experiences/Spintowin/Site/Views::emails/samsung_booth.php' );
         \Dsc\System::instance()->get('mailer')->send('chris@ammonitenetworks.com', 'Someone has won a Samsung prize', array($html) );
          /* \Dsc\System::instance()->get('mailer')->send('carli.yim@bell.ca', 'Someone has won a Samsung prize', array($html) );
          \Dsc\System::instance()->get('mailer')->send('leila.weller@bell.ca', 'Someone has won a Samsung prize', array($html) );
          */
           \Dsc\System::instance()->get('mailer')->send('gordon@crosscliq.com', 'Someone has won a Samsung prize', array($html) );
        


               $array = array('status' => 'winner', 'prize' => $prize->cast());
              break;

            default:   
          $f3->set('attendee', $attendee);
          $f3->set('random', rand());
          $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Experiences/Spintowin/Site/Views::emails/bell_attendee.php' );
          \Dsc\System::instance()->get('mailer')->send($attendee->email, 'Winner! Bell Prize', array($html) );

          $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Experiences/Spintowin/Site/Views::emails/bell_booth.php' );
         \Dsc\System::instance()->get('mailer')->send('chris@ammonitenetworks.com', 'Someone has won a prize', array($html) );
       /*    \Dsc\System::instance()->get('mailer')->send('carli.yim@bell.ca', 'Someone has won a prize', array($html) );
          \Dsc\System::instance()->get('mailer')->send('leila.weller@bell.ca', 'Someone has won a prize', array($html) );
            \Dsc\System::instance()->get('mailer')->send('caroline.walsh@bell.ca', 'Someone has won a prize', array($html) );
         */  \Dsc\System::instance()->get('mailer')->send('gordon@crosscliq.com', 'Someone has won a prize', array($html) );
       
              $array = array('status' => 'prize', 'prize' => $prize->cast());
              break;
          }
          
        } else {

           return $array = array('status' => 'loser', 'prize' => array());
        }
       
       
  return $array;
    }


}
