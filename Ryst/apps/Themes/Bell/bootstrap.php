<?php
class BellThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Bell';


    protected function runSite()
    {   
        
        require('BellRoles.php');
        \Dsc\System::instance()->getDispatcher()->addListener(BellRoles::instance());
        $f3 = \Base::instance();
      

        if(!is_dir($f3->get('PATH_ROOT').'public/Bell')) {
            $publictheme = $f3->get('PATH_ROOT').'public/Bell';
            $admintheme = $f3->get('PATH_ROOT').'apps/Themes/Bell/media';
            $res = symlink( $admintheme, $publictheme );
        }
       
    }

}
$app = new BellThemeBootstrap();
$app->command('pre','Site');
$app->command('run','Site');
$app->command('post','Site');

