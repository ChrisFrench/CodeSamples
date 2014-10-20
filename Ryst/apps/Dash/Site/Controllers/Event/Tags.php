<?php 
namespace Dash\Site\Controllers\Event;

class Tags extends \Dash\Site\Controllers\BaseAuth 
{
    
    public function dashboard($f3) {
        \Base::instance()->set('pagetitle', 'Tags');
        \Base::instance()->set('subtitle', '');
        
        
        $model = new \Dash\Site\Models\Event\Event;
        $event = $model->getAllEventInfo($f3->get('PARAMS.eventid'));
    
        \Base::instance()->set('event', $event );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setLayout('dash.php');
        echo $view->render('Dash/Site/Views::event/tags/dashboard.php');
    }

    public function download($f3) {
        \Base::instance()->set('pagetitle', 'Tags');
        \Base::instance()->set('subtitle', '');
        
        
        $model = new \Dash\Site\Models\Event\Tags;
        $event = $model->getAllEventInfo($f3->get('PARAMS.eventid'));
    
        \Base::instance()->set('event', $event );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setLayout('dash.php');
        echo $view->render('Dash/Site/Views::event/tags/dashboard.php');
    }

    public function generate($f3) {
        \Base::instance()->set('pagetitle', 'Tags');
        \Base::instance()->set('subtitle', '');
        
        
        $model = new \Dash\Site\Models\Event\Tags;
        $event = $model->getAllEventInfo($f3->get('PARAMS.eventid'));
    
        \Base::instance()->set('event', $event );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setLayout('dash.php');
        echo $view->render('Dash/Site/Views::event/tags/dashboard.php');
    }

}


?>