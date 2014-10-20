<?php 
namespace Crossbox\Site\Controllers;

class Device extends \Dsc\Controller  
{   
    //handles displays and public routes
    public function route() {

        $f3 = \Base::instance();
        $f3->set('eventid', $f3->get('event.db'));

        $devices = new \Dash\Site\Models\Event\Devices;

        $uid = $this->inputfilter->clean( $f3->get('PARAMS.name'), 'alnum' );
      
        $model = $devices->setState('filter.device_id', $uid);
        
        try {
            $item = $model->getItem();

            if($item) {
                $controller = new $item->controller;
                $action = $item->action;
                $controller->$action($item);                
            } 

        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
           
            return;
        }    


    }

    //A Crossbox, was just tapped on by a wristband. 
    //
    //
    //
    public function tap() {
        $f3 = \Base::instance();	
		
       
        
        
        
        //THE BOX WAS JUST TAPPED, SO WE NEED TO LOAD THE USERS BAND.
        try {
            $tag = (new \Rystband\Site\Models\Tags)->setState('filter.tagid',$f3->get('PARAMS.tagid'))->getItem();
                if(empty($tag->id)) {
                    echo 'Tag Does Not Exist';
                    return;
                }
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Tag not found" . $e->getMessage(), 'error');
            echo  $e->getMessage();
            //This is where we would load the registration page based off the experiences? 
            return;
        }  

        //If we are here, we have a tag, lets do some routing if we have a special case we would handle that here I guess.
        switch ($tag->type) {
            case 'special':
                # code...
                break;

            case 'event':
            default:
            //OK WE ARE AT AN EVENT 
		
            	
            //LOAD THE EVENT So we can query for the experience this box is attached too.
             $event = (new \Dash\Site\Models\Events)->setState('filter.id',$tag->{'event.id'})->getItem();
            // OK so we have the event we can now load the Experiences for this box
           
             $experience = (new \Dash\Site\Models\Event\Experiences)->setState('filter.device_id',trim($f3->get('POST.uid')))->setState('filter.event_id',$event->id)->getItem();
            //Pass the information over to the Experiences Launcher, This allows us to keep out user experiences code all in in Rystbands Sites app.
             $controller = new \Rystband\Site\Controllers\Experience;
			
             \Dsc\Activities::track('SmartStation Tapped : '. trim($f3->get('POST.uid')) . ' by tag ' . $tag->tagid  ,array('event' => $event->{'name'}, 'experience' => $experience->{'name'}  ));
             
             $controller->launch($experience, $event, $tag);

             die();
                # code...
                break;
        }


    }

    //handles crossboxes
    public function sysTap($tagid, $uid, $time) {
        $f3 = \Base::instance();

        //THE BOX WAS JUST TAPPED, SO WE NEED TO LOAD THE USERS BAND.
        try {
        $tag = (new \Rystband\Site\Models\Tags)->setState('filter.tagid',$tagid)->getItem();
            
            if(empty($tag->id)) {
                echo 'Tag Does Not Exist';
                return;
            }

        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Tag not found" . $e->getMessage(), 'error');
            echo  $e->getMessage();

            //THIS is where we would load the registration page based off the experinces? 

            return;
        }  

        //OK SO WE HAVE A TAG LETS FIGURE OUT WHAT TIME OF TAG AND DO SOME ROUTING
        switch ($tag->type) {
            case 'special':
                # code...
                break;
            
            default:
            //OK WE ARE AT AN EVENT 
             \Dsc\System::instance()->get('session')->set('checkin.time', $time);
            //LOAD THE EVENT
             $event = (new \Dash\Site\Models\Events)->setState('filter.id',$tag->{'event.id'})->getItem();
            
            // OK so we have the event we can now load the Experiences for this box
             $experience = (new \Dash\Site\Models\Event\Experiences)->setState('filter.device_id',$uid)->setState('filter.event_id',$event->id)->getItem();
             
            //Pass the information over to the Experiences Launcher
             $controller = new \Rystband\Site\Controllers\Experience;
             $controller->launch($experience, $event, $tag);

             die();
                # code...
                break;
        }


    }

     public function sync() {
        
         $f3 = \Base::instance();
        
         $my_file = file_get_contents($_FILES['file']['tmp_name']);

         $array = explode("\n", $my_file);
         $array = array_filter($array);
        
         $uid = trim($f3->get('POST.uid'));   
         foreach ($array as $key => $value) {
            if($value) {
             $peices = explode(' ', $value);
             $url = explode('/', $peices[0]);
             $tagid = end($url);
             $this->sysTap($tagid, $uid, $peices[1]);  
            }
             
         }

     }

     public function getWPAConf() {
        $f3 = \Base::instance();
        $f3->set('UI', '../apps/Crossbox/Site/Views/' );
        $view=new \View;
        echo $view->render('WPAconf.php');
     }


}
