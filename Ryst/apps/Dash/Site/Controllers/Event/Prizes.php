<?php 
namespace Dash\Site\Controllers\Event;

class Prizes extends \Dash\Site\Controllers\BaseAuth 
{
    
    public function index() {
        \Base::instance()->set('pagetitle', 'Prizes');
        \Base::instance()->set('subtitle', '');
        
        $model = new \Dash\Site\Models\Event\Prizes;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        $list = $model->paginate();
     
        
        \Base::instance()->set('list', $list );
       
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/prizes/list.php');
    }

}


?>