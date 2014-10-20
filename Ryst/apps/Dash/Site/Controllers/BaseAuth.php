<?php 
namespace Dash\Site\Controllers;

class BaseAuth extends \Users\Site\Controllers\Auth
{

	
    /**
     * Requires an identity for the current user,
     * and either redirects to login screen (if global_app can be determined)
     * or throws an exception 
     *  
     * @throws \Exception
     * @return \Dsc\Controller
     */
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
            	    $f3->reroute('/login');            	    
            	    break;
            	 case "dash":
            	    \Dsc\System::addMessage( 'Please login' );
            	    \Dsc\System::instance()->get('session')->set('dash.login.redirect', $path);
            	    $f3->reroute('/login');            	    
            	    break;
            	default:
                    throw new \Exception( 'Missing identity and unkown application' );
            	    break;
            }
            
            return false;
        }
        
        return $this;
    }
}
?>