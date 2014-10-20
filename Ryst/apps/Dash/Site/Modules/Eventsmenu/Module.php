<?php 
namespace Dash\Site\Modules\Eventsmenu;

class Module extends \Modules\Abstracts\Module
{
    public function html()
    {
        
        \Base::instance()->set('module', $this);
      
        \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Views/', 'Dash/Site/Modules/Eventsmenu/Views' );
        $string = \Dsc\System::instance()->get('theme')->renderLayout('Dash/Site/Modules/Eventsmenu/Views::default.php');
        
        
        return $string;
    }
}