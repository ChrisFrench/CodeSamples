<?php
class RystbandThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'RystbandTheme';


    protected function runSite()
    {   

        $f3 = \Base::instance();
       
        \Dsc\System::instance()->get('theme')->setTheme('RystbandTheme', $f3->get('PATH_ROOT') . 'apps/RystbandTheme/' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/RystbandTheme/Views/', 'RystbandTheme/Views' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views' );
		
        if(!is_link($f3->get('PATH_ROOT').'public/media')) {
        	$publictheme = $f3->get('PATH_ROOT').'public/media';
        	$admintheme = $f3->get('PATH_ROOT').'apps/RystbandTheme/media';
        	$res = symlink( $admintheme, $publictheme );
        }
   
    }

}
$app = new RystbandThemeBootstrap();

