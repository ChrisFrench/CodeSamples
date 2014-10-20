<?php
class AppBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'App';
	
    /**
     * Register this app's view files for all global_apps
     * @param string $global_app
     */
    protected function registerViewFiles($global_app)
    {
    	\Dsc\System::instance()->get('theme')->registerViewPath($this->dir . '/' . $global_app . '/Views/', $this->namespace . '/' . $global_app . '/Views');
    }
    
    
    protected function runSite()
    {    

        $f3 = \Base::instance();
       \Dsc\System::instance()->get('router')->mount( new \App\Site\Routes, $this->namespace );
        
        \Dsc\System::instance()->getDispatcher()->addListener(\App\Listener::instance());
 
        parent::runSite();
    }

    protected function runAdmin()
    {   
        $f3 = \Base::instance();
       

        parent::runAdmin();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }


}
$app = new AppBootstrap();