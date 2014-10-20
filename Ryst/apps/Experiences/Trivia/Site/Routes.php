<?php
namespace Experiences\Trivia\Site;

class Routes extends \Dsc\Routes\Group
{
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Experiences\Trivia\Site\Controllers',
            'url_prefix' => '/experience/trivia' 
        ) );
        
    
        
        $this->add('/game/@id', 'POST', array(
        		'controller' => 'Controller',
        		'action' => 'finish'
        ));
        
         $this->app->route('GET /trivia/@bandid/@token',
	        function() {
	        	
				$actor = (new \Users\Models\Users ())->setState ( 'filter.auto_login_token', $this->app->get('PARAMS.token') )->getItem ();
				
				if (empty ( $actor->id )) {
				
				} else {
					$this->auth->setIdentity($actor);
					$this->app->reroute('/b/'.$this->app->get('PARAMS.bandid'));
					return;
				}
	        }
        );

       
    }
}