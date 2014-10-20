<?php 
namespace Dash;

class Pusherlistener extends \Prefab 
{   

    public function onAfterSaveDashModelsEvents( $event )
    {   
    	
        $mapper = $event->getArgument('mapper');
        
        //$this->addDefaultRoles($mapper->event_id);
       // $this->addUsers($mapper->event_id);
       // $this->addAttendees($mapper->event_id);
       // $this->addTags($mapper->event_id);
        return $event;
    }

 
}