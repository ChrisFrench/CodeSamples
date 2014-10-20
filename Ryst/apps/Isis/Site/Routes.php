<?php

namespace Isis\Site;

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
					'namespace' => '\Isis\Site\Controllers',
					'url_prefix' => '/isis'
				)
		);
		$this->add( '/launcher', 'GET', array(
								'controller' => 'Launcher',
								'action' => 'index'
								));
		
		$this->add( '/launchspintowin', 'GET', array(
				'controller' => 'Launcher',
				'action' => 'launchEventSpin'
		));
		
		$this->add( '/launchspinwinner', 'GET', array(
				'controller' => 'Launcher',
				'action' => 'launchEventSpinWin'
		));
		
		$this->add( '/launchspinloser', 'GET', array(
				'controller' => 'Launcher',
				'action' => 'launchEventSpinLose'
		));
		
	}
}