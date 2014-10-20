<?php
class ZDazBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'ZDaz';

     protected function runAdmin()
    {  
    
    	parent::runAdmin();  
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
    
    protected function runSite()
    {   
    	\Dsc\System::instance()->getDispatcher()->addListener(\ZDas\Listener::instance());
    	 
    	\Dsc\System::instance()->get('router')->mount( new \ZDas\Site\Routes );
    	 
   	 parent::runSite();
    //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
}

$app = new ZDazBootstrap();