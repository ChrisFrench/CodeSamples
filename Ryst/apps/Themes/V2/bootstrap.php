<?php
class V2ThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'V2';


    protected function runSite()
    {   
    	require('DasRoles.php');
    	\Dsc\System::instance()->getDispatcher()->addListener(DasRoles::instance());
    	 
    	\Dsc\System::instance()->get('theme')->setTheme('V2', $this->app->get('PATH_ROOT') . 'apps/Themes/V2/' );
    	\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Themes/V2/Views/', 'V2/Views' );
    	 
    	
    	if(!is_link ($this->app->get('PATH_ROOT').'public/V2')) {
    		$publictheme =  $this->app->get('PATH_ROOT').'public/V2';
    		$admintheme =  $this->app->get('PATH_ROOT').'apps/Themes/V2/media';
    		$res = symlink( $admintheme, $publictheme );
    	}

       
   
    }

}
$app = new V2ThemeBootstrap();
$app->command('pre','Site');
$app->command('run','Site');
$app->command('post','Site');
