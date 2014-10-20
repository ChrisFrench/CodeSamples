<?php

namespace Api\Site\Controllers;

class Signup extends Base {
	
	public function doSignup() {
		
		
		$array = $this->getInputs();
			
		
		$errors = array();
		
		if(empty($array["first_name"])) {
			$errors[] = 'first_name is required';
		}
		if(empty($array["last_name"])) {
			$errors[] = 'last_name is required';
		}
		if(empty($array["email"])) {
			$errors[] = 'email is required';
		}
		if(empty($array["password"])) {
			$errors[] = 'password is required';
		}
		
		
		
		if(!empty($errors)) {
			
			$this->apiError(implode(', ', $errors) . ' You sent: ' . implode(', ', array_keys($_REQUEST)) );
		}
		
		
		
		try {
			
		
			
			$data = array(
					'email' => trim( strtolower( $this->input->get( 'email', null, 'string' ) ) ),
					'first_name' => $this->input->get( 'first_name', null, 'string' ),
					'last_name' => $this->input->get( 'last_name', null, 'string' ),
					'new_password' => $this->input->get( 'password', null, 'string' ),
					'confirm_new_password' => $this->input->get( 'password', null, 'string' )
			);
			
			
			$user = new \Api\Models\Users();
			$user->bind($data);
			$user->set('auto_login.token', $user->generateRandomString(20))->save();
			
			if(!empty($user->id)) {
				$results = $this->app->get('results');
				$results['message'] = 'User Created Successfully';
				$results['result']['first_name'] = $user->first_name;
				$results['result']['last_name'] = $user->last_name;
				$results['result']['email'] = $user->email;
				$results['result']['token'] = $user->{'auto_login.token'};
				$results['redirect'] = 'http://ryst.cc/user?key='.$results['result']['token'];
				$this->app->set('results', $results);
			}	
			
			
		} catch (\Exception $e) {
			$this->apiError($e->getMessage());
		}
		
		
		
		
		
		
	}
	
}
