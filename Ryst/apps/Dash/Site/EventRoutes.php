<?php

namespace Dash\Site;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class EventRoutes extends \Dsc\Routes\Group{
	
	
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
					'namespace' => '\Dash\Site\Controllers\Event',
					'url_prefix' => '/@eventid'
				)
		);
		
		

		/*Event Routes */
		$this->add( '/dashboard',  array( "GET", "POST"), array(
				'controller' => 'Event',
				'action' => 'index'
		));
        $this->add( '/moveact',  array( "GET", "POST"), array(
                'controller' => 'Activity',
                'action' => 'movetoattendee'
        ));

        $this->addCrudGroup('Attendees', 'Attendee');
        $this->add( '/attendees/tocsv',  array( "GET", "POST"), array(
                'controller' => 'Attendees',
                'action' => 'toCSV'
        ));
        
        $this->addCrudGroup('Wristbands', 'Wristband');
        $this->add( '/wristbands/generate',  array( "GET"), array(
                'controller' => 'Wristbands',
                'action' => 'generate'
        ));
        
        $this->add( '/wristbands/generate',  array( "POST"), array(
                'controller' => 'Wristbands',
                'action' => 'doGenerating'
        ));
         $this->add( '/wristbands/csv',  array( "GET"), array(
                'controller' => 'Wristbands',
                'action' => 'doCSV'
        ));

        $this->addCrudGroup('Prizes', 'Prize');
        $this->addCrudGroup('Users', 'User');
        $this->addCrudGroup('Roles', 'Role');
        $this->addCrudGroup('Experiences', 'Experience');
        

        $this->addCrudGroup('Social', 'Social');
    
	}
}