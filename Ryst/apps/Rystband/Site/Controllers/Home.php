<?php 
namespace Rystband\Site\Controllers;

class Home extends Base 
{
    public function index()
    {   
   		//if($this->auth->getIdentity()->id) {
   			
   			$this->app->reroute('/user');
   	//	}
    	
        $this->app->set('pagetitle', 'Home');
         $this->app->set('subtitle', '');


        echo  $this->theme->render('Rystband/Site/Views::event/home/index.php');
    }
    
  

}
