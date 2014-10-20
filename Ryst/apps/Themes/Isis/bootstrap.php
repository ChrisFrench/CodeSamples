<?php
class IsisThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Isis';


    protected function runSite()
    {   
        
        require('IsisRoles.php');
        \Dsc\System::instance()->getDispatcher()->addListener(IsisRoles::instance());
        $f3 = \Base::instance();
      

        if(!is_dir($f3->get('PATH_ROOT').'public/Isis')) {
            $publictheme = $f3->get('PATH_ROOT').'public/Isis';
            $admintheme = $f3->get('PATH_ROOT').'apps/Themes/Isis/media';
            $res = symlink( $admintheme, $publictheme );
        }
       
    }

}
$app = new IsisThemeBootstrap();
$app->command('pre','Site');
$app->command('run','Site');
$app->command('post','Site');

