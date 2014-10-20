<?php

namespace Dash\Site;

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
					'namespace' => '\Dash\Site\Controllers',
					'url_prefix' => ''
				)
		);
		
		$this->add( '/', 'GET', array(
								'controller' => 'Dashboard',
								'action' => 'index'
								));

		$this->add( '/login', 'GET', array(
				'controller' => 'Login',
				'action' => 'index'
		));

		$this->add( '/login', 'POST', array(
				'controller' => 'Login',
				'action' => 'auth'
		));

		/*Event Routes */
		$this->add( '/@eventid/dashboard', 'GET', array(
				'controller' => 'Event',
				'action' => 'index'
		));

        $this->addCrudItem('Event', array('url_prefix' => '/event'));

          
		

	}
}