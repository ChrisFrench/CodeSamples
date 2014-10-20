<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Home extends Auth 
{

    
    public function index($f3)
    {
       $f3->set('pagetitle', 'Home');
       $f3->set('subtitle', '');
        
       $view = \Dsc\System::instance()->get( 'theme' );
       echo $view->render('Rystband/Site/Views::event/employee/home/index.php');
    }

}