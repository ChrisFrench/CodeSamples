<?php

namespace ZDas\Site;

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
					'namespace' => '\ZDas\Site\Controllers',
					'url_prefix' => '/das'
				)
		);
		$this->add( '/login', 'GET', array(
								'controller' => 'Login',
								'action' => 'index'
								));
		$this->add( '/login/sso/@email', 'GET', array(
				'controller' => 'Login',
				'action' => 'sso'
		));
		
		$this->add( '/login', 'POST', array(
				'controller' => 'Login',
				'action' => 'doLogin'
		));
		
		$this->add( '/offline', 'GET', array(
				'controller' => 'Offline',
				'action' => 'index'
		));
		
		$this->add( '/tap', 'GET', array(
				'controller' => 'Das',
				'action' => 'tap'
		));
		
		$this->add( '/tap/watch/@channel', 'GET', array(
				'controller' => 'Das',
				'action' => 'watchChannel'
		));
		
		$this->add( '/register', 'POST', array(
				'controller' => 'Register',
				'action' => 'doRegister'
		));
		
		$this->add( '/profile/@id', 'GET', array(
				'controller' => 'Tap',
				'action' => 'index'
		));
		
		$this->add( '/cache.rystcache', 'GET', array(
				'controller' => 'Appcache',
				'action' => 'manifest'
		));
		$this->add('/@id', 'GET', array(
				'controller' => 'User',
				'action' => 'read'
		));
		
		$this->add( '/vipregister/tapper', 'GET', array(
				'controller' => 'Vipregister',
				'action' => 'tapper'
		) );
		
		$this->add( '/vipregister/scanner', 'GET', array(
				'controller' => 'Vipregister',
				'action' => 'scanner'
		) );
		 
		$this->add( '/vipregister/auth/@channel/@key', 'GET', array(
				'controller' => 'Vipregister',
				'action' => 'login'
		) );
		
		$this->add( '/vipregister/scanner/@channel', 'GET', array(
				'controller' => 'Vipregister',
				'action' => 'scanner'
		) );
		 
		$this->add( '/vipregister/scanner/@channel', 'POST', array(
				'controller' => 'Vipregister',
				'action' => 'doRegister'
		) );
		
		$this->add( '/attendee/sendsms/@id', 'GET', array(
				'controller' => 'Attendee',
				'action' => 'sendSMS'
		) );
		
		$this->add( '/attendee/sendemail/@id', 'GET', array(
				'controller' => 'Attendee',
				'action' => 'sendEmail'
		) );
		
		$this->add( '/attendee/perks', 'POST', array(
				'controller' => 'Attendee',
				'action' => 'savePerk'
		) );
		
		$this->add( '/photobooth', 'GET', array(
				'controller' => 'Das',
				'action' => 'photobooth'
		) );
		
		$this->app->route('GET /user/@id', '\ZDas\Site\Controllers\User->read' );
		$this->app->route('GET /i/@tagid', '\ZDas\Site\Controllers\Das->survey' );
		$this->app->route('POST /das/survey/save', '\ZDas\Site\Controllers\Das->surveySave' );
		
	}
}