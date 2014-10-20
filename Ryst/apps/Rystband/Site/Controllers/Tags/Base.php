<?php 
namespace Rystband\Site\Controllers\Tags;

class Base extends \Dsc\Controller 
{
    public function index()
    {
        \Base::instance()->set('pagetitle', 'Home');
        \Base::instance()->set('subtitle', '');
        
       
        //$view = \Dsc\System::instance()->get( 'theme' );
        //echo $view->render('home/default.php');
    }

    
}
?> 