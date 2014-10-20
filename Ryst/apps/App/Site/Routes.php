<?php

namespace App\Site;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Routes extends \Dsc\Routes\Group{
	
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){

		$this->setDefaults(
				array(
					'namespace' => '\App\Site\Controllers',
					'url_prefix' => '/app'
				)
		);
		
		$this->add( '/home', 'GET|POST', array(
				'controller' => 'Home',
				'action' => 'index'
		));
		
		$this->add( '/profile', 'GET|POST', array(
								'controller' => 'Profile',
								'action' => 'index'
								));
		$this->add( '/settings', 'GET|POST', array(
				'controller' => 'Settings',
				'action' => 'index'
		));
		
		
		
		
	}
}