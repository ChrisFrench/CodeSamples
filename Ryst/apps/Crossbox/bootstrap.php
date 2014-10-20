<?php
class CrossboxBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Crossbox';

    protected function runDevice()
    {
    	\Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
        //\Dsc\System::instance()->getDispatcher()->addListener(\Rystband\Userlistener::instance());
        //\Dsc\System::instance()->getDispatcher()->addListener(\Rystband\Pusherlistener::instance());
    }
}
$app = new CrossboxBootstrap();