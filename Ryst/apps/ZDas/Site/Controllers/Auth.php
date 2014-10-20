<?php 
namespace ZDas\Site\Controllers;

class Auth extends Base
{
	/* public function beforeRoute()
	{
		$this->requireIdentity();
	}
	
	public function rememberMe()
	{
		$cookie = isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : '';
		//\FB::log($cookie);
		if ($cookie)
		{
			list ($user, $token, $mac) = explode(':', $cookie);
			
			if ($mac !== hash_hmac('sha256', $user . ':' . $token, '345aFdfdf4565fgfg3sdfjker'))
			{
				//\FB::log('FAIL 1');
				return false;
			}
			$user = (new \Rystband\Site\Models\Attendees())->setState('filter.id', $user)->getItem();
	
			if ($user->{'cookie.token'} == $token)
			{
				//\FB::log('Setting identity, hooray');
				$this->auth->setIdentity($user);
			}
			else
			{
				//\FB::log('FAIL 2');
			}
		}
	}
	
	public function requireIdentity()
	{
		//\FB::log('requireIdentity');
		$f3 = \Base::instance();
		$identity = $this->getIdentity();
	
		if (empty($identity->id))
		{
			$this->rememberMe();
			$identity = $this->getIdentity();
		}
	
		if (empty($identity->id))
		{
			$path = $this->inputfilter->clean($f3->hive()['PATH'], 'string');
			if ($query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY))
			{
				$path .= '?' . $query;
			}
	
			$global_app_name = strtolower($f3->get('APP_NAME'));
			switch ($global_app_name)
			{
				case "admin":
					\Dsc\System::addMessage('Please login');
					\Dsc\System::instance()->get('session')->set('admin.login.redirect', $path);
					$f3->reroute('/admin/login');
					break;
				case "site":
					\Dsc\System::addMessage('Please login');
					\Dsc\System::instance()->get('session')->set('site.login.redirect', $path);
	
					$f3->reroute('/das/login');
	
					break;
				default:
					throw new \Exception('Missing identity and unkown application');
					break;
			}
	
			return false;
		}
	
		return $this;
	}
 */

}
