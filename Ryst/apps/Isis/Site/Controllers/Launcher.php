<?php 
namespace Isis\Site\Controllers;

class Launcher extends Base {
   	
	function index() {
	
		echo $this->theme->render('Isis/Site/Views::launcher/index.php');
	}
	
	function launchEventSpin() {
		
		exec('curl -A "device CROSSCLIQ" -X POST  -F "uid=examplespin1" http://ryst.cc/b/isis1');

	}
	function launchEventSpinWin() {
		
		$pusher = new \Pusher('5b98106a361e7ee3d043', '4859aeb5be107a9766c8', '68280');
		$data = array('attendee' => array('first_name' => 'Example Player'), 'game' =>  array('status' => 'winner', 'prize' => array('name' => 'Prize name', 'prize_id' => 122, 'prize_image' => 'http://placehold.it/350x350?text=Awesome+Prize')));
		$pusher->trigger('examplespin1', 'play', $data);	
		
	}
	function launchEventSpinLose() {
		$pusher = new \Pusher('5b98106a361e7ee3d043', '4859aeb5be107a9766c8', '68280');
		$data = array('attendee' => array('first_name' => 'Example Player'), 'game' =>  array('status' => 'loser', 'prize' => array()));
		$pusher->trigger('examplespin1', 'play', $data);
	}
}
