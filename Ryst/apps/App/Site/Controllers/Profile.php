<?php

namespace App\Site\Controllers;

class Profile extends Auth {
	
	public function index() {
		$this->app->reroute('/user');
		
	}
	
}
