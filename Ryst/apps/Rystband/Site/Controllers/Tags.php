<?php 
namespace Rystband\Site\Controllers;

class Tags extends Base 
{	

	 protected function getModel() 
    {
        $model = new \Rystband\Models\Rystbands;
        return $model; 
    }
    
    public function connect() {
    	echo  $this->theme->render('Rystband/Site/Views::tags/connect.php');
    }
    
    public function doConnect() {
    	$tag = \Dsc\System::instance()->get( 'session' )->get( 'tag');
    	
    	//TODO somehow make getIdentity() use \Rystband\Models\Users class
    	$user = $this->auth->getIdentity();
    	$user = (new \Rystband\Models\Users)->setState('filter.id', $user->id)->getItem();
    	
    	if(!empty($tag->id) && !empty($user->id)) {
    		try {
    			$user->addRystband($tag);
    			\Dsc\System::instance()->addMessage( 'Success', 'error');
    		} catch (\Exception $e) {
    			\Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
    			 
    		}
    		
    	} else {
    		\Dsc\System::instance()->addMessage( 'Something went wrong', 'error');
    		
    	}
    	$this->app->reroute('/b/'.$tag->id);
    	
    }

    public function routing($f3)
    {
        
        try {
            $tagid = $f3->get('PARAMS.tagid');
            $model = $this->getModel()->setState('filter.tagid', $tagid);
            $tag = $model->getItem();
           
            if($tag) {

                if(!empty($tag->{'event.id'})) {
                  $f3->set('eventid', $tag->{'event.id'}); 
                  //OK we have an event load it into memory
                  $event = (new  \Dash\Site\Models\Events)->setState('filter.id',$tag->{'event.id'})->getItem();
                 
                  $f3->set('event',  $event); 
                  
                  //for a lack of better place to put this,
                  if($event->theme) {
                    $path = $f3->get('PATH_ROOT') . 'apps/Themes/';
                     if (file_exists( $path . $event->theme . '/bootstrap.php' )) {
                     require_once($path . $event->theme . '/bootstrap.php');
                     
                   
                     \Dsc\System::instance()->get( 'session' )->set( 'site.theme.override', $event->theme );
                     
                     \Dsc\System::instance()->get('theme')->setTheme($event->theme, $f3->get('PATH_ROOT') . 'apps/Themes/'.$event->theme.'/' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Themes/'.$event->theme.'/Views/', 'Themes/'.$event->theme.'/Views' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views' );
                    }
                  } 
      
                }


                switch ($tag->type) {
                    case 'special':
                        $controller = new $tag->{'actions.controller'};
                        $action = $tag->{'actions.action'};
                        $controller->$action($tag);
                        break;
                    
                    default:
                      $controller = new  \Rystband\Site\Controllers\Tags\Event;
                      $controller->action($tag);
                        break;
                }
                
                
            } else {
              \Dsc\System::instance()->addMessage( "Not Registered Band", 'error');
              $view = \Dsc\System::instance()->get( 'theme' );
              echo $view->render('Rystband/Site/Views::tags/empty.php');
            }
            
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
           
            return;
        }    

    }   


      
    
     

}
