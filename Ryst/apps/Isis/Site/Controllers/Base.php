<?php 
namespace Isis\Site\Controllers;

class Base extends \Dsc\Controller 
{
   	
	function beforeroute() {
	
		
		\Dsc\System::instance()->get('theme')->setTheme('Innovation', $this->app->get('PATH_ROOT') . 'apps/Themes/Innovation/' );
		\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Themes/Innovation/Views/', 'Themes/Innovation/Views' );
		\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Isis/Site/Views/', 'Isis/Site/Views' );
	}

}
