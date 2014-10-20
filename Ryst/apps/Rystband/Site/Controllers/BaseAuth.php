<?php 
namespace Rystband\Site\Controllers;

class BaseAuth extends Base 
{	
	

    public function beforeRoute($f3){
    	
    	//get current auth
    	$auth = $this->auth->getIdentity();
    		
    	//accessToken fix, confirm apps are using key and delete
    	if (empty ( $array ['key'] )) {
    		if(!empty($array ['accessToken'])) {
    			$array ['key'] = $array ['accessToken'];
    		}
    	}
    		
    		
    	if(!empty($auth->id)) {
    	
    		//we are logged in
    	} else {
    		//not logged in look in request for key
    		$array = $this->input->getArray ();
    	
    		if (empty ( $array ['key'] )) {
    	
    		} else {
    			$key = $array ['key'];
    			$actor = (new \Users\Models\Users ())->setState ( 'filter.auto_login_token', $key )->getItem ();
    	
    			if (empty ( $actor->id )) {
    	
    			} else {
    				$this->auth->setIdentity($actor);
    	
    				return;
    			}
    		}
    	
    			
    	}
    	
    	
    	
       $this->requireIdentity();
       
    }    


}
