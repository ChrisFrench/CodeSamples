<?php

namespace Dash\Admin;

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
					'namespace' => '\Dash\Admin\Controllers',
					'url_prefix' => '/admin'
				)
		);
		
        // settings routes
		$this->addSettingsRoutes( '/customers' );
		
		//users list
		$this->addCrudList( 'Customers' );
				
		//user crud
		$this->addCrudItem( 'Customer' );

	}
}