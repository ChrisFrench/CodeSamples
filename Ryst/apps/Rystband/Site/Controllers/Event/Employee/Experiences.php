<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Experiences extends Auth 
{

    
    public function index($f3)
    {  
        $f3->set('pagetitle', 'Gate Keeper');
        $f3->set('subtitle', '');
        
       $event = (new  \Dash\Site\Models\Events)->setState('filter.eventid',$f3->get('PARAMS.eventid'))->getItem();
      
        $f3->set('event',  $event); 
        $model = new \Dash\Site\Models\Event\Experiences;
        $model->setState('filter.event_id',  $f3->get('event')->id);
        $experiences = $model->getList();
        
        $f3->set('experiences', $experiences); 

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Site/Views::event/employee/experiences/index.php');

    }
     // use session as experiences display

     public function asBox() {
        $uid =  \Dsc\System::instance()->get( 'session' )->get('experience_uid');
        $model = new \Dash\Site\Models\Event\Experiences;
        $model->setState('filter.event_id',   \Base::instance()->get('event')->id);
        $experience = $model->setState('filter.device_id', $uid)->getItem(); 
        \Base::instance()->set('experience',  $experience);

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Site/Views::event/employee/experiences/box.php');

     }

     public function asDisplay() {
        $uid =  \Dsc\System::instance()->get( 'session' )->get('experience_uid');

        $model = new \Dash\Site\Models\Event\Experiences;
        $model->setState('filter.event_id',   \Base::instance()->get('event')->id);
        $experience = $model->setState('filter.device_id', $uid)->getItem(); 
        \Base::instance()->set('experience',  $experience);

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Site/Views::event/employee/experiences/display.php');

     }

     public function checkinSession() {
        $f3 = \Base::instance();

        \Dsc\System::instance()->get( 'session' )->set( 'session_event', $f3->get('POST.session_event'));

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Site/Views::event/employee/experiences/box.php');

     }


     public function active() {

        $f3 = \Base::instance();
        $model = new \Dash\Site\Models\Event\Experiences;
        $model->setState('filter.event_id',  $f3->get('event')->id);
        $experience = $model->setState('filter.id', $f3->get('PARAMS.id'))->getItem(); 
        
        \Dsc\System::instance()->get( 'session' )->set( 'active_role', 'experience_dispatcher'); 
        \Dsc\System::instance()->get( 'session' )->set( 'experience_uid', $experience->device_id); 
 
        //TODO add dispaly support
        
        $this->asBox();
   }
   
}