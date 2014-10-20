<?php

namespace Rystband\Site\Routes;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Event extends \Dsc\Routes\Group{
	
	
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
					'namespace' => '\Rystband\Site\Controllers\Event\Employee',
					'url_prefix' => '/@eventid'
				)
		);
		$this->add( '/home', 'GET', array(
								'controller' => 'Home',
								'action' => 'index'
								));
		$this->add( '/magic', 'GET', array(
								'controller' => 'Home',
								'action' => 'magic'
								));
		$this->add( '/signup', 'GET', array(
								'controller' => 'showSignup',
								'action' => 'showLogin'
								));
		$this->add( '/signup', 'POST', array(
								'controller' => 'showSignup',
								'action' => 'doSignup'
								));
		$this->add( '/login', 'GET', array(
								'controller' => 'Login',
								'action' => 'index'
								));
		$this->add( '/login', 'POST', array(
								'controller' => 'Login',
								'action' => 'auth'
								));
  		$this->add( '/logout', 'GET', array(
								'controller' => 'User',
								'action' => 'logout'
								));
  		$this->add( '/attendee', 'GET', array(
								'controller' => 'Attendee',
								'action' => 'index'
								));
  		$this->add( '/gatekeeper', 'GET', array(
								'controller' => 'Gatekeeper',
								'action' => 'index'
								));
  		$this->add( '/experiences', 'GET', array(
								'controller' => 'Experiences',
								'action' => 'index'
								));
  		$this->add( '/attendee/register', 'POST', array(
								'controller' => 'Attendee',
								'action' => 'doRegister'
								));
  		$this->add( '/roles', 'GET', array(
								'controller' => 'Users',
								'action' => 'roles'
								));
        $this->add( '/active/role/@roleid', 'GET', array(
								'controller' => 'Users',
								'action' => 'role'
								));     
        						
         $this->add( '/active/experience/@id', 'GET', array(
								'controller' => 'Experiences',
								'action' => 'active'
								)); 
         $this->add( '/experience/box', 'GET', array(
								'controller' => 'Experiences',
								'action' => 'asBox'
								)); 
         $this->add( '/set/checkin/session', 'POST', array(
								'controller' => 'Experiences',
								'action' => 'checkinSession'
								)); 
	}
}