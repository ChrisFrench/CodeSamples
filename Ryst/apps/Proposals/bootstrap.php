<?php
class ProposalsBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Proposals';

     protected function runAdmin()
    {   $f3 = \Base::instance();
        \Dsc\System::instance()->get('router')->mount( new \Proposals\Admin\Routes );
         \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Admin/Views/', 'Proposals/Admin/Views' );
         

        parent::runAdmin();
        
     //   \Dsc\System::instance()->get('router')->mount( new \Crossbox\Site\Routes, $this->namespace );
    }
}
$app = new ProposalsBootstrap();