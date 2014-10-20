<?php

namespace Rystband\Site\Routes;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Experiences extends \Dsc\Routes\Group{
	
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){

		$this->setDefaults(
				array(
					'namespace' => '\Rystband\Site\Controllers',
					'url_prefix' => '/e'
				)
		);

		$this->add( '/@eid/@did', 'GET', array(
								'controller' => 'Experience',
								'action' => 'display'
								));



	}
}