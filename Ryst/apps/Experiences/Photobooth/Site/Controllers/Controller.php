<?php 
namespace Experiences\Photobooth\Site\Controllers;

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
		
		$pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
		
		if(!$attendee) {
			$data = array('tag' => (array) $tag->cast());
			$pusher->trigger($experience->{'pusher.channel'}, 'noAttendee', $data);
			return;
		}
		
		//If there is an image lets do this
		if(!empty($_FILES['image'])) {
			
			$options = array();
			$options['type'] = 'experience.photobooth';
			$options['name'] = 'V2-'.uniqid();
			$options['tags'] = array('v2', $attendee->first_name . ' ' . $attendee->last_name, $tag->tagid );
						
			
			
			$asset = 	\ZDas\Models\Assets::createFromUpload($_FILES['image'], $options);
			
			$data = array('photo' => 'http://ryst.cc/asset/'.$asset->slug, 'attendee' => (array) $attendee->cast());
			$pusher->trigger($experience->{'pusher.channel'}, 'photo', $data);
			
			
			
		} else {
		//ELSE we are at beginning	
			//trigger External Screen
			
				$data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast());
				$pusher->trigger($experience->{'pusher.channel'}, 'begin', $data);
		

		}
		
		

        if(@$experience->userdevice)  {
        // trigger phone 
        $pusher = new \Pusher($f3->get('pusher_key'), $f3->get('pusher_secret'), $f3->get('pusher_app_id'));
        $data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'content' => '/content/car' );
        $pusher->trigger($tag->tagid, 'content', $data);
        }
	}
  
  


}