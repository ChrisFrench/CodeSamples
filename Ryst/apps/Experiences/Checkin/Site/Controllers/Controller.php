<?php 
namespace Experiences\Checkin\Site\Controllers;

class Controller extends \Experiences\Base\Site\Controllers\Base 
{   
  	 	
	function launch($tag, $event, $experience) {

    	if(empty($tag)) {
              echo 'This band has no wristband tag in the tags collection'. "\n";
              return;
        }

        $attendee = null;
        $f3 = \Base::instance();
        if(!empty($tag->{'attendee.id'})) {
          $attendees = new \ Dash\Site\Models\Event\Attendees;
          $attendees->setState('filter.id', $tag->{'attendee.id'});
          $attendee = $attendees->getItem();
        }
      

         $checkins =  $experience->checkins;
         $date = new \DateTime();
         $checkins[] = array('id' =>  $attendee->id, 'name'=> $attendee->first_name .' '. $attendee->last_name, 'time' => $date->format('Y-m-d H:i:s'));
         $experience->checkins = $checkins;
         $experience->save();
        
         $f3->set('tag',$tag);
         $f3->set('event',$event);
         $f3->set('experience',$experience);
         $f3->set('attendee',$attendee);


         \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'Experiences/Checkin/Site/Views/', 'Experiences/Checkin/Site/Views' );
         $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Experiences/Checkin/Site/Views::email/attendee.php' );
         \Dsc\System::instance()->get('mailer')->send($attendee->email, 'Successful Checkin', array($html) );
         $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Experiences/Checkin/Site/Views::email/eventmanager.php' );
         \Dsc\System::instance()->get('mailer')->send('shae.petersen@gmail.com', 'Successful Checkin', array($html) );
         
    
        //trigger External Screen
    /*    if(@$experience->displays)  {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
    			  $data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'game' => $this->gamePlay());
    			  $pusher->trigger($experience->{'pusher.channel'}, 'play', $data);
        }

        if(@$experience->userdevice)  {
        // trigger phone 
        $pusher = new \Pusher($f3->get('pusher_key'), $f3->get('pusher_secret'), $f3->get('pusher_app_id'));
        $data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'content' => '/content/car' );
        $pusher->trigger($tag->tagid, 'content', $data);
        } */
	}


}