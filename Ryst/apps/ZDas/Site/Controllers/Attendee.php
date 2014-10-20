<?php 
namespace ZDas\Site\Controllers;

class Attendee extends Auth 
{
   	
	
	function sendSMS() {
		
		$attendee = (new \Rystband\Site\Models\Attendees)->setState('filter.id', $this->app->get('PARAMS.id'))->getItem();
		
		$tag = (new \Rystband\Site\Models\Tags)->setState('filter.id',(string) $attendee->tagid)->getItem();
		
		
		$sid = "AC987e6946d5276512f023e5f2c959c918"; // Your Account SID from www.twilio.com/user/account
		$token = "cb27cc45ca033b6bc5b0b87f143b955c"; // Your Auth Token from www.twilio.com/user/account
		
		$client = new \Services_Twilio($sid, $token);
		
		$message = $client->account->messages->sendMessage(
				'8014365344', // From a valid Twilio number
				$attendee->phone, // Text this number
				'Das Energi : http://ryst.cc/i/'.$tag->tagid . ' Complete your profile.'
		);
		
		print $message->sid;
	}
	
	
	function sendEmail() {
		$attendee = (new \Rystband\Site\Models\Attendees)->setState('filter.id', $this->app->get('PARAMS.id'))->getItem();
		
		$tag = (new \Rystband\Site\Models\Tags)->setState('filter.id',(string) $attendee->tagid)->getItem();
		
		$this->app->set('tag', $tag);
		$this->app->set('attendee', $attendee);
		
		$subject = 'Das Energi';
		$html = \Dsc\System::instance()->get( 'theme' )->renderView( 'ZDas/Site/Views::emails_html/vip.php' );
		$text = \Dsc\System::instance()->get( 'theme' )->renderView( 'ZDas/Site/Views::emails_text/vip.php' );
		
		\Dsc\System::instance()->get('mailer')->send($attendee->email, $subject, array($html, $text), 'donotreply@ryst.cc', 'Das Energi' );
		
		
	}
	
	function savePerk() {
	
			$perk = $this->app->get('POST.perk');
			$this->app->get('POST.id');
		
			$attendee = (new \Rystband\Site\Models\Attendees)->setState('filter.id', $this->app->get('POST.id'))->getItem();
			$attendee->set('perks.'.$perk, 'received');
			$attendee->save();
			
			$result = array('msg' => 'success');
			return json_encode($result);
	}
	
	

}
