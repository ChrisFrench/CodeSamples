<?php

namespace App\Site\Controllers;

class Settings extends Auth {
	
	public function index() {
		
		echo $this->theme->render('App/Site/Views::settings/index.php');
	}
	
}
