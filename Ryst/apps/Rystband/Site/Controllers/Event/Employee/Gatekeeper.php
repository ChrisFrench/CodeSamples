<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Gatekeeper extends Auth 
{

    
    public function index($f3)
    {
        $f3->set('pagetitle', 'Gate Keeper');
        $f3->set('subtitle', '');
        
           $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Site/Views::event/employee/gatekeeper/index.php');
    }

    public function gate() {

    }





    
}