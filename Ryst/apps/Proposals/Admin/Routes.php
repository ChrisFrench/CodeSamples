<?php

namespace Proposals\Admin;

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
					'namespace' => '\Proposals\Admin\Controllers',
					'url_prefix' => '/admin'
				)
		);
		
		$this->addCrudGroup( 'Proposals', 'Proposal' );
		
        $this->add( '/proposal/generate/@id', 'GET', array(
								'controller' => 'Pdf',
								'action' => 'generate'
								));

          
		

	}
}