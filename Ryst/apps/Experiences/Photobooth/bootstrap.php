<?php
class PhotoboothBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Experiences\Photobooth';

    protected function runSite()
    {   
        \Dsc\System::instance()->get( 'theme' )->registerViewPath( $this->dir . '/Site/Views/',  'Experiences/Photobooth/Site/Views' );

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

$app = new PhotoboothBootstrap();