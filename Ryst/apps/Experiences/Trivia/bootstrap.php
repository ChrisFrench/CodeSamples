<?php
class TriviaBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Experiences\Trivia';

    protected function runSite()
    {   
        \Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Site/Views/',  'Experiences/Trivia/Site/Views' );
        \Dsc\System::instance()->getDispatcher()->addListener(\Experiences\Trivia\Listener::instance());
        \Dsc\System::instance()->get('router')->mount( new \Experiences\Trivia\Site\Routes, $this->namespace );
        parent::runSite();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
    protected function runAdmin()
    {   
 
    	\Dsc\System::instance()->get('router')->mount( new \Experiences\Trivia\Admin\Routes, $this->namespace );
    	\Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Admin/Views/',  'Experiences/Trivia/Admin/Views' );
    	\Dsc\System::instance()->getDispatcher()->addListener(\Experiences\Trivia\Listener::instance());
        parent::runAdmin();
     
    }

    protected function runDash()
    {   
    	\Dsc\System::instance()->getDispatcher()->addListener(\Experiences\Trivia\Listener::instance());
    	 
    	\Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Site/Views/',  'Experiences/Trivia/Dash/Views' );
    	 
    }

}

$app = new TriviaBootstrap();