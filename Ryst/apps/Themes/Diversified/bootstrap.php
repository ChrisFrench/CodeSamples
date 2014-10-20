<?php
class DiversifiedThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Diversified';


    protected function runSite()
    {   

        $f3 = \Base::instance();
      

        if(!is_dir($f3->get('PATH_ROOT').'public/Diversified')) {
            $publictheme = $f3->get('PATH_ROOT').'public/Diversified';
            $admintheme = $f3->get('PATH_ROOT').'apps/Themes/Diversified/media';
            $res = symlink( $admintheme, $publictheme );
        }
       
    }

}
$app = new DiversifiedThemeBootstrap();
$app->command('pre','Site');
$app->command('run','Site');
$app->command('post','Site');

