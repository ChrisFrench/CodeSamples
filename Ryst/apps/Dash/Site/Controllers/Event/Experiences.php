<?php 
namespace Dash\Site\Controllers\Event;

class Experiences extends \Dash\Site\Controllers\BaseAuth 
{   
   
    
    public function index() {
        \Base::instance()->set('pagetitle', 'Experiences');
        \Base::instance()->set('subtitle', '');
        
        $model = new \Dash\Site\Models\Event\Experiences;
    
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
     
        $list = $model->paginate();
        
        \Base::instance()->set('list', $list );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/experiences/list.php');
    }


   
}



?>