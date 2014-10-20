<?php

namespace App\Site\Controllers;

class Home extends Auth {
	
	public function index() {
		
		echo $this->theme->render('App/Site/Views::home/index.php');
	}
	
}
