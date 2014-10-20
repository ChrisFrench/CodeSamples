<?php
class IsisBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Isis';

     protected function runAdmin()
    {  
    
    	parent::runAdmin();  
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
    
    protected function runSite()
    {   
    	//\Dsc\System::instance()->getDispatcher()->addListener(\Isis\Listener::instance());
    	 
    	\Dsc\System::instance()->get('router')->mount( new \Isis\Site\Routes );
    	 
   	 parent::runSite();
    //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
}

$app = new IsisBootstrap();