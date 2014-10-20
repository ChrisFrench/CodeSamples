<?php
namespace Rystband\Site\Controllers\Users;


/**
 * Any private controllers -- controllers that require authentication 
 * in order to execute ANY AND ALL of their methods -- 
 * can extend this class.  
 * 
 * Alternatively, just run $this->requireIdentity() inside your restricted methods.
 *
 */
class Auth extends \Users\Site\Controllers\Auth
{
    public function beforeRoute()
    {
    	
    	$auth = $this->auth->getIdentity();
    	 //testing   	
    		if(!empty($auth->id)) {
    			
    		
    		
    		$array = $this->input->getArray ();
    		 
    		if (empty ( $array ['key'] )) {
    			 
    		} else {
    			$key = $array ['key'];
    			$user = (new \Rystband\Models\Users ())->setState ( 'filter.auto_login_token', $key )->getItem ();
    		
    			if (empty ( $user->id )) {
    				 
    			} else {
    				$this->auth->setIdentity($user);
    		
    				return;
    			}
    		}
    		
    		
    		
    	} else {
    		
    		 
    		if (empty ( $array ['key'] )) {
    			if(!empty($array ['accessToken'])) {
    				var_dump($array ['accessToken']); die();
    				$array ['key'] = $array ['accessToken'];
    			}
    			 
    		}
    		
    		
    		$array = $this->input->getArray ();
    	
    		if (empty ( $array ['key'] )) {
    	
    		} else {
    			$key = $array ['key'];
    			$user = (new \Rystband\Models\Users ())->setState ( 'filter.auto_login_token', $key )->getItem ();
    			 
    			if (empty ( $user->id )) {
    			
    			} else {
    				$this->auth->setIdentity($user);
    				
    				return;
    			}
    		}
    	
    		
    	}
    	
    	
    	
        $this->requireIdentity();
    }
    
}
