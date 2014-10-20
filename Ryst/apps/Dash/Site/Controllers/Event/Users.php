<?php 
namespace Dash\Site\Controllers\Event;

class Users extends \Dash\Site\Controllers\BaseAuth 
{
    

     public function index()
    {
   //     $this->checkAccess( __CLASS__, __FUNCTION__ );
        
        $model = new \Dash\Site\Models\Event\Users;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated );
        
     //   $model = $this->getModel('groups');
      //  $groups = $model->getList();
      //  \Base::instance()->set('groups', $groups );
        
        //$view = \Dsc\System::instance()->get('theme');
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/users/list.php');
    }

}


?>