<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Meetgreets extends Auth 
{   

    
     public function display()
    {
        \Base::instance()->set('pagetitle', 'Prize Patrol');
        \Base::instance()->set('subtitle', '');
                
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('meetgreet/home.php');
    }

}
