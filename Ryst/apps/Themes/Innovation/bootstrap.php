<?php
class InnovationThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Innovation';


    protected function runSite()
    {   
        
        require('InnovationRoles.php');
        \Dsc\System::instance()->getDispatcher()->addListener(InnovationRoles::instance());
        $f3 = \Base::instance();
      

        if(!is_dir($f3->get('PATH_ROOT').'public/Innovation')) {
            $publictheme = $f3->get('PATH_ROOT').'public/Innovation';
            $admintheme = $f3->get('PATH_ROOT').'apps/Themes/Innovation/media';
            $res = symlink( $admintheme, $publictheme );
        }
       
    }

}
$app = new InnovationThemeBootstrap();
$app->command('pre','Site');
$app->command('run','Site');
$app->command('post','Site');

