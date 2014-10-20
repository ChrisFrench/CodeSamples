<?php 
namespace Experiences\Employee\Site\Controllers;

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
		$data = array('route' => 'http://ryst.cc/b/'.$tag->tagid);
		$pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
		$pusher->trigger($experience->{'device_id'}, 'redirect', $data);
		
		return;
		

	}
  
  


}