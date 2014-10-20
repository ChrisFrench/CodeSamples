<?php 
namespace Experiences\Trivia\Site\Controllers;

class Controller extends \Experiences\Base\Site\Controllers\Base 
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
		}
		
		//lets check to see if the user has already played this game.
		if(!empty($attendee->{'game.trivia.'.$game->id})) {
			$this->pusher->trigger($experience->{'device_id'}, 'alreadyPlayed', $data);
			return;
		};
	
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
	
		//display
		$data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast());
		$this->pusher->trigger($experience->{'device_id'}, 'play', $data);
	
	
	
		if(@$experience->userdevice)  {
			// trigger phone
			$data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'content' => '/content/car' );
			$this->pusher->trigger($tag->tagid, 'content', $data);
		}
	}
	
	
	
	
  		
	
    
	function finish() {
		$inputs = $this->input->getArray();
		$gameid = $this->app->get('PARAMS.id');
		
		// now lets load the game
		$game = (new \Experiences\Trivia\Models\Games())->setState('filter.id', $gameid)->getItem();
		
		$correct = 0;
		$score = 0;
		foreach ($inputs['answers'] as $key => $answer)
		{
		
			$gameAnswers = (new \Experiences\Trivia\Models\Questions())->setState('filter.id', $key)->getItem();
			if (!empty($gameAnswers->id))
			{
				$value = (int) $gameAnswers->{'answers.' . $answer . '.value'};
				if ($value)
				{
					$correct++;
					$score = $score + $value;
				}
			}
		}
		// UPDATE THE USER with the questions, score, value
		$user = (new \Rystband\Models\Users())->setState('filter.id', $inputs['player'])->getItem();
		
		$gameArray = array(
				'title' => $game->title,
				'answers' => (array) $inputs['answers'],
				'correct' => $correct,
				'score' => $score
		);
		$user->set('game.trivia.' . $gameid, $gameArray);
		$user->set('experience','');
		$user->save();
		
		
		$experience = (new \Dash\Site\Models\Event\Experiences)->setState('filter.id',$inputs['experience'])->getItem();
		$experience->set('player', '')->store();
		
		echo $this->outputJson ( $this->getJsonResponse ( array('message'=> 'Success') ) );
		
		
	}


}