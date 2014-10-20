<?php 
namespace Rystband\Site\Controllers;

class Pusher extends Base 
{	
	
	
	/*
	 * This is the Auth Method
	 * TODO we need to make this code check the user is actually authenticated etc
	 * */
	
    public function index()
    {   
   
    	
    	echo $this->pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
    }

}
