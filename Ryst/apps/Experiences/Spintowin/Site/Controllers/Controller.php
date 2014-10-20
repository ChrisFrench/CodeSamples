<?php 
namespace Experiences\Spintowin\Site\Controllers;

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

        if(!$attendee) {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
            $data = array('tag' => (array) $tag->cast());
            $pusher->trigger($experience->{'pusher.channel'}, 'noAttendee', $data);
        }

       

        //trigger External Screen
        if(@$experience->displays)  {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
    			  $data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'game' => $this->gamePlay());
    			  $pusher->trigger($experience->{'pusher.channel'}, 'play', $data);
        }

        if(@$experience->userdevice)  {
        // trigger phone 
        $pusher = new \Pusher($f3->get('pusher_key'), $f3->get('pusher_secret'), $f3->get('pusher_app_id'));
        $data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'content' => '/content/car' );
        $pusher->trigger($tag->tagid, 'content', $data);
        }
	}
  
    protected function gamePlay($attendee) {

        $rand = rand(1, 10); 

        switch ( $rand) {
          case  ($rand < "5"):
            $array = array('status' => 'winner', 'prize' => array('name' => 'Prize name', 'prize_id' => 122, 'prize_image' => 'http://placehold.it/350x350?text=Awesome+Prize'));
                break;
            default:
              $array = array('status' => 'loser', 'prize' => array());
                break;
        }	
	return $array;
    }


}