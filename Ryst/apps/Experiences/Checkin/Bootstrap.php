<?php
class CheckinBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Experiences\Checkin';

    protected function runSite()
    {   
        \Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Site/Views/',  'Experiences/Checkin/Site/Views' );

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
         \Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Dash/Views/',  'Experiences/Checkin/Dash/Views' );

    }

}

$app = new CheckinBootstrap();