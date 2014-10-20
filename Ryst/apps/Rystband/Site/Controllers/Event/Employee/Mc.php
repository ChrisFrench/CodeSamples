<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Mc extends Auth 
{

    
    public function display()
    {
        \Base::instance()->set('pagetitle', 'MC');
        \Base::instance()->set('subtitle', '');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('mc/home.php');
    }

}