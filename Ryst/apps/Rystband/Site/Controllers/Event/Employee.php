<?php

namespace Rystband\Site\Controllers\Event;

class Employee extends Base 
{   
     public function dologin() {
        $f3 =  \Base::instance();
        $tagid = $f3->get('PARAMS.tagid');  
        $error = false;

        $model = (new \Dash\Site\Models\Event\Attendees);
        $post = $f3->get('POST');
        if(count($post)) {

        } else {
            $error = true;
            \Dsc\System::instance()->addMessage('Missing required fields', 'error');
        }

        foreach ($f3->get('POST') as $key => $value) {
          
            if(empty($value)) {
                 \Dsc\System::instance()->addMessage(str_replace('_', ' ', $key).' is required', 'error');
                 $error = true;
            } 
            if($error == false) {

             $model->setState('filter.'.$key, $value);
            }
        }

        if($error) {
            $f3->reroute(str_replace('/login', '', $f3->get('PARAMS[0]')));
        }

        $item = $model->getItem();
        //Someone could be on someone elses page when giving this screen so we login them in  as them selves but redirect them back to the tapped band. 

        if(!empty($item->id)) {
        $tag = (new \Dash\Site\Models\Event\Tags)->setState('filter.id', $item->tagid)->getItem();        
        } else {
          \Dsc\System::instance()->addMessage('The provided information did not match our records', 'error');  
             $f3->reroute(str_replace('/login', '', $f3->get('PARAMS[0]')));
        }
       
        if($item->id) {
           //todo make a get/setIdentity method like f3-users users
            \Dsc\System::instance()->get( 'session' )->set( 'attendee', $item );
            \Dsc\System::instance()->get( 'session' )->set( 'home', '/b/'. $tag->tagid );
            \Base::instance()->reroute('/b/'.$tagid);
           
        } else {
            \Dsc\System::addMessage( 'Login failed', 'error' );
            \Base::instance()->reroute('/b/'.$tagid);
        }

     }

     public function dologout() {
         $reroute =  \Dsc\System::instance()->get( 'session' )->get( 'home');
         if(empty( $reroute )) {
             $reroute = '/';
         } 
             \Base::instance()->clear('SESSION');
             \Base::instance()->clear('COOKIE');
             setcookie('id','',time()-3600);
             \Dsc\System::instance()->get('session')->destroy();
        \Base::instance()->reroute( $reroute );
     }



     public function dispatch($tag) {
		
     	
     	
     	$user = $this->auth->getIdentity();
     	
     	//CHECK TO SEE IF WE ARE LOGGED IN.
     	if(!empty($user->id)) {
     		 
     		//ok the new band doesn't have an attendee lets show them a register page
     		if(empty($tag->attendee)) {
     			\Dsc\System::instance()->get( 'session' )->set( 'tag',$tag);
     			$this->app->reroute('/rystband/connect');
     			exit();
     		}
     		 
     		$banduser = (new \Rystband\Models\Users)->setState('filter.id', $tag->{'attendee.id'})->getItem();
     	
     		//if(!empty($user->id)) {
     		//We are logged in
     		$this->app->set('user',$user);
     		if((string) $banduser->id  == (string) $tag->{'attendee.id'} ) {
     			$this->app->set('user',$banduser);
     				//THIS IS YOUR BAND show profile
     				$this->own($tag);
     		return;
     	
     		} else {
     			 
     			//THIS IS ANOTHER BAND/OR A BAND WI
     			$this->usermanage($banduser,$tag);
     		
     		}
     		//}
     		 
     	}  else {
     		 
     		//BAND IS REGISTERED BUT YOU ARE NOT LOGGED IN
     		\Dsc\System::instance()->get( 'session' )->set( 'site.login.redirect', '/b/'.$tag->tagid );
     		
     		$this->app->reroute('/signin');
     		 
     	}
     	

     	
     	//ok the new band doesn't have an attendee lets show them a register page
     	if(empty($tag->attendee)) {
     		\Dsc\System::instance()->get( 'session' )->set( 'tag',$tag);
     		$this->app->reroute('/rystband/connect');
     		exit();
     	}
     	
     	
     		
     		$user = (new \Rystband\Models\Users)->setState('filter.id', $tag->{'attendee.id'})->getItem();
     		 
     		//if(!empty($user->id)) {
     			//We are logged in
     			$this->app->set('user',$user);
     		
     				if(!empty($user->experience)) {
     					$this->experience($user,$tag);
     				} else {
     					//THIS IS YOUR BAND show profile
     					$this->usermanage($user,$tag);
     				}

     		
     		//}
     
     	
         exit();
     	
     }

     protected function register($tag) {
          $view = \Dsc\System::instance()->get( 'theme' );
          echo $view->render('Rystband/Site/Views::event/attendee/register.php');
     }
     protected  function usermanage($user,$tag) {
     	$view = \Dsc\System::instance()->get( 'theme' );
     	echo $view->render('Rystband/Site/Views::event/employee/attendee/manage.php');
     }
     
     
     protected function own($tag) {
     
     
     	$view = \Dsc\System::instance()->get( 'theme' );
     	 
     	echo $view->render('Rystband/Site/Views::event/attendee/own.php');
     }
     
     
     protected function other($tag) {

        //check to see if this band is registered if not add a message and ruturn to own band
        //if it is registered  than show their profile
          if(!$tag->{'attendee.id'}) {
            \Dsc\System::addMessage('The Ryst band you typed is not activated', 'error' );
            \Base::instance()->reroute('/user');
          } else {
           
            
            $user = (new \Rystband\Models\Users)->setState('filter.id', $tag->{'attendee.id'})->getItem();
            
            \Base::instance()->set('user',$user);
            \Base::instance()->set('tag',$tag);
            
            $view = \Dsc\System::instance()->get( 'theme' );
  
            echo $view->render('Rystband/Site/Views::event/attendee/other.php');
          }
    
     }

    

    
}
