<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Users extends Auth 
{
  
    protected function getModel() {
        $model = new \Rystband\Models\Site\Users;
        return $model;
    }
    


   public function roles($f3) {
        $user = $this->getIdentity();
      
        $f3->set('roles', $user->roles);
    
        $pusher = new \Pusher($f3->get('pusher_key'), $f3->get('pusher_secret'), $f3->get('pusher_app_id'));
        $pusher->trigger('rolestest', 'test', array( 'msg' => 'hi working'));

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Site/Views::event/employee/roles/list.php');
   }


   public function role() {
   		  $f3 = \Base::instance();
        $model = new \Rystband\Site\Models\Roles;
        $role = $model->setState('filter.id', $f3->get('PARAMS.roleid'))->getItem(); 
        

        \Dsc\System::instance()->get( 'session' )->set( 'active_role', $role->type); 
 
        switch ($role->type) {

            case 'attendee_registration':
               $f3->reroute('/'.$f3->get('event')->event_id.'/attendee');
                break;
             case 'prize_patrol':
               $f3->reroute('/'.$f3->get('event')->event_id.'/prizepatrol');
                break;
            case 'meet_greet':
               $f3->reroute('/'.$f3->get('event')->event_id.'/meetgreet');
                break;
            case 'ticketing':
               $f3->reroute('/'.$f3->get('event')->event_id.'/ticketing');
                break;
            case 'mc':
               $f3->reroute('/'.$f3->get('event')->event_id.'/mc');
                break;
            case 'band_transfer':
               $f3->reroute('/'.$f3->get('event')->event_id.'/transfer');
                break;
            case 'gate_keeper':
            case 'event_attendance':
               $f3->reroute('/'.$f3->get('event')->event_id.'/gatekeeper');
                break;
            case 'experience_dispatcher':
               $f3->reroute('/'.$f3->get('event')->event_id.'/experiences');
                break;    
            default:
                # code...
                break;
        }
       
   }
    
}