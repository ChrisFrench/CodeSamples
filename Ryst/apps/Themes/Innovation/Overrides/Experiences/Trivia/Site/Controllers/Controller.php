<?php 

class ControllerOverride extends \Experiences\Trivia\Site\Controllers\Controller 
{   
  function display($event, $experience) {
  	
  	if(!empty($experience->player)) {
  		$view = \Dsc\System::instance()->get( 'theme' );
  		$view->setVariant('content.php');
  		echo $view->render('Experiences/Trivia/Site/Views::display/game.php');
  		 
  	} else {
  		$view = \Dsc\System::instance()->get( 'theme' );
  		$view->setVariant('content.php');
  		echo $view->render('Experiences/Trivia/Site/Views::display/index.php');
  	}
 
  }	 	  

  
  function launch($tag, $event, $experience) {
  	
  	$settings = \Pusher\Models\Settings::fetch();
  	$this->pusher =  new \Pusher\Pusher($settings->{'pusher.key'}, $settings->{'pusher.secret'}, $settings->{'pusher.app_id'});
  	
  	//Make sure the user hasn't already played this game
  	\Dsc\System::instance()->get('session')->set($experience->{'device_id'}.'.state', 'play');
  	 
	  	if(empty($tag)) {
	  		$this->pusher->trigger($experience->{'device_id'}, 'badTag', array());
	  		echo 'This band has no wristband tag in the tags collection'. "\n";
	  		return;
	  	}
  	
        
        $attendee = null;
        $f3 = \Base::instance();
        if(!empty($tag->{'attendee.id'})) {
		  $attendees = new \Rystband\Models\Users;
          $attendees->setState('filter.id', $tag->{'attendee.id'});
          $attendee = $attendees->getItem();
    
        }
		
        if(!$attendee) {
            $data = array('tag' => (array) $tag->cast());
            $this->pusher->trigger($experience->{'device_id'}, 'noAttendee', $data);
            return;
        }
        $game = (new \Experiences\Trivia\Models\Games)->setState('filter.id', $experience->game)->getItem();
        
        
        //lets check to see if the user has already played this game.
        /*if(!empty($attendee->{'game.trivia.'.(string) $game->id})) {
        	$this->pusher->trigger($experience->{'device_id'}, 'alreadyPlayed', array());
        	return;
        };*/
        
        
        
        if(empty($attendee->{'auto_login.token'})) {
        	$attendee->set('auto_login.token', $attendee->generateRandomString(20, true));
        }
        
        
        if(!empty($attendee->phone)) {
        	//OK SEND THE SMS
        	$sid = "AC987e6946d5276512f023e5f2c959c918"; // Your Account SID from www.twilio.com/user/account
        	$token = "cb27cc45ca033b6bc5b0b87f143b955c"; // Your Auth Token from www.twilio.com/user/account
        	
        	$client = new \Services_Twilio($sid, $token);
        	
        	$message = $client->account->messages->sendMessage(
        			'8014365344', // From a valid Twilio number
        			$attendee->phone, // Text this number
        			'Trivia: http://ryst.cc/trivia/'.$tag->tagid.'/'.$attendee->{'auto_login.token'}
        	);
        	
        	print $message->sid;
        } else {
        	$data = array('tag' => (array) $tag->cast());
        	$this->pusher->trigger($experience->{'device_id'}, 'noAttendeePhone', $data);
        }
       
        
        
        
        
        $array= array();
        $array['tag'] = $tag->tagid;
        $array['attendee'] = $attendee->id;
        $experience->set('player', $array);
        $experience->save();
        $array= array();
        $array['id'] =  $experience->id;
        $array['view'] = 'Experiences/Trivia/Site/Views::user/index.php';
        $array['device_id'] =  $experience->device_id;
        
        $attendee->set('experience', $array);
        $attendee->save();
        
         //display ok so we tapped the page lets reload the display
        $data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast());
        $this->pusher->trigger($experience->{'device_id'}, 'play', $data);

        
        
        if(@$experience->userdevice)  {
        // trigger phone 
        $data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'content' => '/content/car' );
        $this->pusher->trigger($tag->tagid, 'content', $data);
        }
  }
  
 


}
