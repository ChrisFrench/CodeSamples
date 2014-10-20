<?php

namespace Rystband\Site\Routes;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Bands extends \Dsc\Routes\Group{
	
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){
		
		$this->setDefaults(
				array(
					'namespace' => '\Rystband\Site\Controllers',
					'url_prefix' => '/b'
				)
		);

		$this->add( '/@tagid', 'GET', array(
								'controller' => 'Tags',
								'action' => 'routing'
								));
		$this->add( '/@tagid/login', 'POST', array(
								'controller' => 'Event\Attendee',
								'action' => 'dologin'
								));
		$this->add( '/@tagid/logout', 'POST|GET', array(
								'controller' => 'Event\Attendee',
								'action' => 'dologout'
								));
		/*$this->add( '/@tagid', 'GET', array(
								'controller' => 'Tags',
								'action' => 'action'
								));
		$this->add( '/@tagid/selfsignup', 'GET', array(
								'controller' => 'Selfregister',
								'action' => 'selfsignin'
								));
		$this->add( '/@tagid/selfsignup', 'POST', array(
								'controller' => 'Selfregister',
								'action' => 'add'
								));
        $this->add( '/@tagid/registerconfirm', 'GET', array(
								'controller' => 'Selfregister',
								'action' => 'registerconfirm'
								));

        $this->add( '/@tagid/alreadyregistered', 'GET', array(
								'controller' => 'Selfregister',
								'action' => 'alreadyregistered'
								));
        $this->add( '/empty', 'GET', array(
								'controller' => 'Tags',
								'action' => 'displayEmpty'
								));
      	*/
       
 

	}
}