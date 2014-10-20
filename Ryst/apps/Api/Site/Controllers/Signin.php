<?php

namespace Api\Site\Controllers;

class Signin extends Base {
	
	public function doSignin() {
		$array = $this->getInputs();
		if(empty($array['user'])) {
			$this->apiError ('User is required');
		}
		if(empty($array['pass'])) {
			$this->apiError ('pass is required');
		}
		
		$model = new \Api\Models\Users;
		$user = $model->setState('filter.email', $array['user'])->getItem();
		
		if(empty($user->id)) {
			$this->apiError('No user was found for this email');
		} else {
			if (password_verify($array['pass'], $user->password))
			{	
				$this->auth->login($user);
				$user = $model->setState('filter.id', $user->id)->getItem();
	
				$results = $this->app->get('results');
				
				$results['result']['first_name'] = $user->first_name;
				$results['result']['last_name'] = $user->last_name;
				$results['result']['email'] = $user->email;
				$results['result']['token'] = $user->{'auto_login.token'};
				
				$results['redirect'] = 'http://ryst.cc/user?key='.$results['result']['token'];
				$this->app->set('results', $results);
			} else {
				$this->apiError ('password does not match');
			}
			
		}
		
		
		
		
	}
	
}
