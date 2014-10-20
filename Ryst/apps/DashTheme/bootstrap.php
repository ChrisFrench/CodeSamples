<?php
class DashThemeBootstrap extends \Dsc\Bootstrap
{
    protected $dir = __DIR__;
    protected $namespace = 'Dash';


    protected function runDash()
    {   

        $f3 = \Base::instance();
       
        \Dsc\System::instance()->get('theme')->setTheme('DashTheme', $f3->get('PATH_ROOT') . 'apps/DashTheme/' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/DashTheme/Views/', 'DashTheme/Views' );
    	\Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Dash/Site/Views/', 'Dash/Site/Views' );

    }

}
$app = new DashThemeBootstrap();

