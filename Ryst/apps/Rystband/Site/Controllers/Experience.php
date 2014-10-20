<?php 
namespace Rystband\Site\Controllers;

class Experience extends Base 
{   
	protected function setTheme($tag) {
		$f3 = \Base::instance();
		//Experiences need themes by default for sending emails
		\Dsc\System::instance()->get('theme')->setTheme('RystbandTheme', $f3->get('PATH_ROOT') . 'apps/RystbandTheme/' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/RystbandTheme/Views/', 'RystbandTheme/Views' );
        \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views' );

        if(!empty($tag->{'event.id'})) {
                
                  //OK we have an event load it into memory
                  $event = (new  \Dash\Site\Models\Events)->setState('filter.id',$tag->{'event.id'})->getItem();
                        
                  //for a lack of better place to put this,
                  if($event->theme) {
                    $path = $f3->get('PATH_ROOT') . 'apps/Themes/';
                     if (file_exists( $path . $event->theme . '/bootstrap.php' )) {
                     require_once($path . $event->theme . '/bootstrap.php');
                     \Dsc\System::instance()->get('theme')->setTheme($event->theme, $f3->get('PATH_ROOT') . 'apps/Themes/'.$event->theme.'/' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Themes/'.$event->theme.'/Views/', 'Themes/'.$event->theme.'/Views' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views' );
                    }
                  } 
      
        }
	}

	public function launch($experience, $event, $tag)
	{
		
		
		
		$f3 = \Base::instance();

		$this->setTheme($tag);
		
		
		$array = explode('\\', $experience->controller);
		
		$array=array_filter($array);
		array_unshift($array, 'Overrides');
		array_unshift($array, $event->{'theme'});
		array_unshift($array, 'Themes');
		array_unshift($array, 'apps');
		//array_unshift($array, '');
		
		$path =  implode('/', $array);
		$path = $f3->get('PATH_ROOT').$path;
		
	
		
		$controller = $experience->controller;
		if(file_exists( $path.'.php')) {		
			require($path.'.php');
			$controller = new \ControllerOverride;
		}
		
		 //Pass the information over to the Experiences Launcher
		
		try {
			//TODO do more error checking and let the experiences  return the error message.
   	 		$controller = new $controller;
            $controller->launch($tag, $event, $experience);

            $message = 'SUCCESS - Experience '.$experience->name .' Launched at ' . $event->name. ' Event with bandID '. $tag->tagid;
		} catch (\Exception $e) {
		    $message = 'FAILURE - '. $e->getMessage();
		}
		finally {
			$session_event = \Dsc\System::instance()->get( 'session' )->get('session_event');
			if(empty($session_event)) {
				echo $message; 
			} else {
				$f3->set('tag',$tag);
				$f3->set('experience',$experience);
				$f3->set('message',$message);
				$view = \Dsc\System::instance()->get( 'theme' );
       			echo $view->render('Rystband/Site/Views::event/employee/experiences/box.php');
			}

			die();
		}
	}

	//handling the display of an experience, http://ryst.cc/b/12345
	public function display()
	{
		
		
		
		$f3 = \Base::instance();
		
		$event = (new \Dash\Site\Models\Events)->setState('filter.eventid', $f3->get('PARAMS.eid'))->getItem();
		
		
		$experience = (new \Dash\Site\Models\Event\Experiences)->setState('filter.device_id',$f3->get('PARAMS.did'))->setState('filter.event_id',$event->id)->getItem();
		
	
		
		$f3->set('event', $event);
		$f3->set('experience', $experience);

		if($event->theme) {
            $path = $f3->get('PATH_ROOT') . 'apps/Themes/';
            if (file_exists( $path . $event->theme . '/bootstrap.php' )) {
                     require_once($path . $event->theme . '/bootstrap.php');
                     \Dsc\System::instance()->get('theme')->setTheme($event->theme, $f3->get('PATH_ROOT') . 'apps/Themes/'.$event->theme.'/' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Themes/'.$event->theme.'/Views/', 'Themes/'.$event->theme.'/Views' );
                     \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'apps/Rystband/Site/Views/', 'Rystband/Site/Views' );
            }
        } 
        $array = explode('\\', $experience->controller);
        
        $array=array_filter($array);
        array_unshift($array, 'Overrides');
        array_unshift($array, $event->{'theme'});
        array_unshift($array, 'Themes');
        array_unshift($array, 'apps');
        //array_unshift($array, '');
        
        $path =  implode('/', $array);
        $path = $f3->get('PATH_ROOT').$path;
        $controller = $experience->controller;
        if(file_exists( $path.'.php')) {
        	require($path.'.php');
        	$controller = new \ControllerOverride;
        		
        	if(method_exists($controller, 'display'))  {
        		$controller->display($event, $experience);
        		return;
        	}
        		
        }
        
		$view = \Dsc\System::instance()->get( 'theme' );
		$view->setVariant('content.php');
        echo $view->render('Experiences/'.$experience->type.'/Site/Views::display/index.php');
	}
}