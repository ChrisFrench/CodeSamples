<?php
namespace ZDas\Site\Controllers;

class User extends \Users\Site\Controllers\User
{
	function beforeroute() {
	
	
		\Dsc\System::instance()->get('theme')->setTheme('V2', $this->app->get('PATH_ROOT') . 'apps/Themes/V2/' );
		\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Themes/V2/Views/', 'Themes/V2/Views' );
		\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/ZDas/Site/Views/', 'ZDas/Site/Views' );
	}
	
	
}
