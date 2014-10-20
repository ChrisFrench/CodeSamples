<?php

namespace App\Site\Controllers;

class Auth extends Base {
	
	public function beforeroute() {
	
		$auth = $this->auth->getIdentity();
		
		if(!empty($array ['accessToken'])) {
			var_dump($array ['accessToken']); die();
			$array ['key'] = $array ['accessToken'];
		}
		
		if (empty ( $array ['key'] )) {
			if(!empty($array ['accessToken'])) {
				var_dump($array ['accessToken']); die();
				$array ['key'] = $array ['accessToken'];
			}
			
		}
		
		
		if(!empty($auth->id)) {
			
			//we are logged in
		} else {

		$array = $this->input->getArray ();
		
		if (empty ( $array ['key'] )) {
			echo 'Key is required';
		} else {
			$key = $array ['key'];
		}
		
		$actor = (new \Api\Models\Users ())->setState ( 'filter.auto_login_token', $key )->getItem ();
		
			if (empty ( $actor->id )) {
				echo 'user not found';
				} else {
				$this->auth->login($actor);
			
				return;
			}
		}
		
			
	}
	
}
