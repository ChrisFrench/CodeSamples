<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Auth  extends \Users\Site\Controllers\Login
{   
    public function requireIdentity()
    {
        $f3 = \Base::instance();
        $identity = $this->getIdentity();
        if (empty($identity->id))
        {
            $path = $this->inputfilter->clean( $f3->hive()['PATH'], 'string' );
            $global_app_name = strtolower( $f3->get('APP_NAME') );
            switch ($global_app_name) 
            {
                case "admin":
                    \Dsc\System::addMessage( 'Please login' );
                    \Dsc\System::instance()->get('session')->set('admin.login.redirect', $path);
                    $f3->reroute('/admin/login');                   
                    break;
                case "site":
                    \Dsc\System::addMessage( 'Please login' );
                    \Dsc\System::instance()->get('session')->set('site.login.redirect', $path);
                    $f3->reroute('/'.$f3->get('event')->event_id.'/login');                 
                    break;
                default:
                    throw new \Exception( 'Missing identity and unkown application' );
                    break;
            }
            
            return false;
        }
        
        return $this;
    }

    public function beforeroute() {
        $f3 = \Base::instance();
        
        $event = (new  \Dash\Site\Models\Events)->setState('filter.eventid',$f3->get('PARAMS.eventid'))->getItem();
        
       
        $f3->set('event',  $event); 
                  
                  //for a lack of better place to put this,
        if($event->theme) {
            $path = $f3->get('PATH_ROOT') . 'apps/Themes/';
                if (file_exists( $path . $event->theme . '/bootstrap.php' )) {
                     require_once($path . $event->theme . '/bootstrap.php');     
                     \Dsc\System::instance()->get('theme')->setTheme($event->theme, $f3->get('PATH_ROOT') . 'apps/Themes/'.$event->theme.'/' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Themes/'.$event->theme.'/Views/', 'Themes/'.$event->theme.'/Views' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views' );
                }
         }

       $this->requireIdentity();
    } 
}