<?php 
namespace Rystband\Site\Controllers\Tags;

class Event extends Base 
{	

	 protected function getModel() 
    {
        $model = new \Rystband\Site\Models\Tags;
        return $model; 
    }

      public function index()
    {
        \Base::instance()->set('pagetitle', 'Home');
        \Base::instance()->set('subtitle', '');
        
       
        //$view = \Dsc\System::instance()->get( 'theme' );
        //echo $view->render('home/default.php');
    }


    public function action($tag)
    {   
        $f3 = \Base::instance();
        
        $tagid = $f3->get('PARAMS.tagid');
        
        $user = $this->auth->getIdentity();
        
        $role = \Dsc\System::instance()->get( 'session' )->get( 'active_role');
            
    	\Dsc\System::instance()->get( 'session' )->set( 'tagid', $tagid );
	
        //If there is a role, we will be able to override the action of tag in the Theme bootstrap
        if($role) { 
        $event = (new \Joomla\Event\Event( 'role_' . $role ))->addArgument('tag', $tag);
        $event = \Dsc\System::instance()->getDispatcher()->triggerEvent($event);  
        } else {
        
        	if($user->role == 'employee' || $user->role == 'root') {
        		$this->employeeTapper($tag, $tagid, $role);
        	} else {
        		$this->attendeeTapper($tag, $tagid, $role);
        	}
        	
        	
       		 
        }
    	
    }
    protected function employeeTapper($tag, $tagid, $role) {
    	//OK this tap what done by an unregistered session we are going to assume it is the bands owner
    	//pass all the information to the Attendee Controller
    	$controller = new \Rystband\Site\Controllers\Event\Employee;
    	$controller->dispatch($tag);
    }
    
    protected function attendeeTapper($tag, $tagid, $role) {
        //OK this tap what done by an unregistered session we are going to assume it is the bands owner
        //pass all the information to the Attendee Controller
        $controller = new \Rystband\Site\Controllers\Event\Attendee;
        $controller->dispatch($tag);
    }


}
