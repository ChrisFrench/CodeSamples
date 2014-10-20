<?php
class BarcodeidBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Experiences\Barcodeid';

    protected function runSite()
    {   
        \Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Site/Views/',  'Experiences/Barcodeid/Site/Views' );

     //   \Dsc\System::instance()->get('router')->mount( new \Experiences\Barcodeid\Site\Routes, $this->namespace );
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
         \Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Dash/Views/',  'Experiences/Barcodeid/Dash/Views' );

    }

}

$app = new BarcodeidBootstrap();