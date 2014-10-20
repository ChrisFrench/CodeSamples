<?php
namespace Rystband\Site\Routes;

class Users extends \Dsc\Routes\Group
{

    public function initialize()
    {
        
        $this->setDefaults(array(
            'namespace' => '\Rystband\Site\Controllers\Users',
            'url_prefix' => ''
        ));
        
        $this->add('/login', 'GET', array(
            'controller' => 'Login',
            'action' => 'index'
        ));

        $this->app->route('GET /sign-in', function () {
        	$this->app->reroute('/signin');
        });
        
        $this->add('/signin', 'GET', array(
            'controller' => 'Login',
            'action' => 'only'
        ));
        $this->add('/signin', 'GET', array(
        		'controller' => 'Login',
        		'action' => 'only'
        ));
        
        $this->add('/signup', 'GET', array(
        		'controller' => 'Login',
        		'action' => 'register'
        ));
        
        $this->add('/login', 'POST', array(
            'controller' => 'Login',
            'action' => 'auth'
        ));
        
        $this->add('/logout', 'GET|POST', array(
            'controller' => 'Login',
            'action' => 'logout'
        ));
        
        $this->add('/register', 'GET', array(
            'controller' => 'Login',
            'action' => 'register'
        ));
        
        $this->add('/register', 'POST', array(
            'controller' => 'Login',
            'action' => 'create'
        ));
        
        $this->add('/login/social', 'GET|POST', array(
            'controller' => 'Login',
            'action' => 'social'
        ));
        
        $this->add('/login/social/auth/@provider', 'GET|POST', array(
            'controller' => 'Login',
            'action' => 'provider'
        ));
        
        $this->add('/login/completeProfile', 'GET', array(
            'controller' => 'Login',
            'action' => 'completeProfileForm'
        ));
        
        $this->add('/login/completeProfile', 'POST', array(
            'controller' => 'Login',
            'action' => 'completeProfile'
        ));
        
        $this->add('/login/validate', 'GET', array(
            'controller' => 'Login',
            'action' => 'validate'
        ));
        
        $this->app->route('POST /login/validate', function ($f3)
        {
            $token = $this->app->get('REQUEST.token');
            $this->app->reroute('/login/validate/token/' . $token);
        });
        
        $this->add('/login/validate/token/@token', 'GET', array(
            'controller' => 'Login',
            'action' => 'validateToken'
        ));
        
        $this->add('/login/validate-email', 'GET', array(
            'controller' => 'Login',
            'action' => 'validateEmail'
        ));

        $this->add('/login/validate-email', 'POST', array(
            'controller' => 'Login',
            'action' => 'validateEmailSubmit'
        ));
    }
}