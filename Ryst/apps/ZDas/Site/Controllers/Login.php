<?php 
namespace ZDas\Site\Controllers;

class Login extends Base 
{
   
	
	
	
	
	public function index() {
 
		echo $this->theme->render('ZDas/Site/Views::login/index.php');
	}
	
	public function doLogin() {
	
		$email = $this->app->get('POST.email');
		
		$user = (new \Users\Models\Users)->setState('filter.email', $email)->getItem();
		if(!empty($user->id)) {
			$this->auth->setIdentity($user);
			
			\Dsc\System::instance()->get( 'session' )->set( 'active_role', 'das_attendee_registration');
				
			$this->app->set('COOKIE.remember_me_das', '53dba9df13ec0216558b4571');
			
			
			$this->app->reroute('/das/tap');
		}
		
	
	
	}
	
	public function sso() {
	
		$email = $this->app->get('PARAMS.email');
	
		$user = (new \Users\Models\Users)->setState('filter.email', $email)->getItem();
		if(!empty($user->id)) {
			$this->auth->setIdentity($user);
				
			\Dsc\System::instance()->get( 'session' )->set( 'active_role', 'das_attendee_registration');
				
			$this->app->reroute('/das/tap');
		}
	

	}
	
	
	

}
