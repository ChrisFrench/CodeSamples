<?php
namespace Experiences\Trivia\Admin;

class Routes extends \Dsc\Routes\Group
{
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Experiences\Trivia\Admin\Controllers',
            'url_prefix' => '/admin/trivia' 
        ) );
        
        $this->addSettingsRoutes();
        
        $this->addCrudGroup( 'Games', 'Game' );
        
        $this->addCrudGroup( 'Questions', 'Question' );
        
        $this->addCrudGroup( 'Categories', 'Category', array(
            'datatable_links' => true,
            'get_parent_link' => true 
        ) );
        $this->add( '', array(
        		'GET',
        		'POST'
        ), array(
        		'controller' => 'Dashboard',
        		'action' => 'index'
        ) );
        
        $this->add('/game/luanchnow/@id', 'GET|POST', array(
        		'controller' => 'Game',
        		'action' => 'launchGameNow'
        ));

        $this->add('/game/@id/deleteuser/@userid', 'GET', array(
        		'controller' => 'Game',
        		'action' => 'deleteUserData'
        ));
        
        $this->add('/game/turnoff/@id', 'GET|POST', array(
        		'controller' => 'Game',
        		'action' => 'gameOff'
        ));
        $this->add( '/categories/checkboxes', array(
            'GET',
            'POST' 
        ), array(
            'controller' => 'Categories',
            'action' => 'getCheckboxes' 
        ) );
    }
}