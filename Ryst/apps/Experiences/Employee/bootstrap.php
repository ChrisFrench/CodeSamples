<?php
class EmployeeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Experiences\Employee';

    protected function runSite()
    {   
        \Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Site/Views/',  'Experiences/Employee/Site/Views' );

        parent::runSite();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
    protected function runAdmin()
    {   
        parent::runAdmin();
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }

    protected function runDash()
    {   
    }

}

$app = new EmployeeBootstrap();