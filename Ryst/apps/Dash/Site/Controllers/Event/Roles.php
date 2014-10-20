<?php 
namespace Dash\Site\Controllers\Event;

class Roles extends \Dash\Site\Controllers\BaseAuth 
{
    
    public function index() {
        \Base::instance()->set('pagetitle', 'Roles');
        \Base::instance()->set('subtitle', '');
        
        $model = new \Dash\Site\Models\Event\Roles;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        $list = $model->paginate();
        \Base::instance()->set('list', $list );
         
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/roles/list.php');
    }

}


?>