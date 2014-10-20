<?php 
namespace Dash\Site\Controllers\Event;

class Event extends \Dash\Site\Controllers\BaseAuth 
{
    
    public function index($f3) {
        \Base::instance()->set('pagetitle', 'Events');
        \Base::instance()->set('subtitle', '');
        
        \Base::instance()->set('SESSION.eventid', strtolower($f3->get('PARAMS.eventid')));
        $event_id =  $f3->get('PARAMS.eventid');
       

        $model = new \Dash\Site\Models\Event\Event;
        
        $event = $model->getAllEventInfo($f3->get('PARAMS.eventid'));
       
        \Base::instance()->set('event', $event );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('dash.php');
        echo $view->render('Dash/Site/Views::event/dashboard.php');
    }

}


?>