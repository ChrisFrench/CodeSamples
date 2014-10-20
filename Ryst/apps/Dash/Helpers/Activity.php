<?php 

namespace Dash\Helpers;



//Convert Activities to Nice humaniness output

Class Activity {

	var $mapper = null;
	var $data = array('id' => '', 'message' => '', 'timestamp' => '', 'name' => '', 'type' => '');
	var $id = '';
	function __construct($activityMapper) {

		$this->mapper = $activityMapper;
		$func = $this->mapper->type;
		
		$this->id = (string) $this->mapper->{'id'};
		 $this->data['id'] = $this->id;
		 $this->data['message'] = $this->mapper->action;	
		 $this->data['timestamp'] = $this->mapper->{'timestamp.local'};
		 $this->data['name'] = $this->mapper->type;
		 $this->data['type'] = $this->mapper->type;



		if(method_exists($this, $func)) {
		 $this->$func();		
		} 
	
		


	}

	function getData(){
		return $this->data;
	}


	function attendee() {

		switch ($this->mapper->action) {
			case 'update':
			 $this->data['id'] = $this->id;
		     $this->data['message'] = $this->mapper->action;
		     
		     if(!empty($this->mapper->{'object.first_name'}) && !empty($this->mapper->{'object.last_name'})) {
		     $this->data['name'] = 'Attendee - ' . $this->mapper->{'object.first_name'} . ' ' . $this->mapper->{'object.last_name'};
		     }
		     $gender = $this->mapper->{'object.gender'};
		     
		     
		     switch (strtolower($gender)) {
		     	case 'male':
		     		 $sextense = 'his';
		     		break;
		     	case 'female':
		     		 $sextense = 'her';
		     		break;
		     	default:
		     		$sextense = 'their';
		     		break;
		     }
		   
		     $this->data['message'] = 'Has updated '. $sextense. ' profile information';
				break;
			case 'created':

		     $this->data['name'] = $this->mapper->{'object.age'} . ' year old ' . $this->mapper->{'object.gender'}. ' from zipcode '	.$this->mapper->{'object.zipcode'}	;		
			 $this->data['id'] = $this->id;

		     $this->data['message'] = 'has create a new profile';		

				break;
			default:
				# code...
				break;
		}

	}



	function wristband() {

		switch ($this->mapper->action) {
			case 'activated':
			 $this->data['id'] = $this->id;
		     $this->data['message'] = 'Band with the ID of ' . $this->mapper->{'object.tagid'} . ' has been activated';
		   
				break;
			case 'update':
				$this->data['message'] = 'Band with the ID of ' . $this->mapper->{'object.tagid'} . ' has been updated';
		   		break;
			default:
				# code...
				break;
		}

	}

	function raffle() {

		switch ($this->mapper->action) {
			case 'played':
			
				break;
			case 'created':

				break;
			default:
				# code...
				break;
		}

	}

	function ticket() {

		switch ($this->mapper->action) {
			case 'redeemed':
				$this->data['message'] = 'A ticket has been redeemed';
				break;
			case 'created':
				$this->data['message'] = 'A new ticket has been created';
				break;
			default:
				# code...
				break;
		}

	}






}