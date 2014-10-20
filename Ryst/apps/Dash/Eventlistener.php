<?php 
namespace Dash;

class Eventlistener extends \Prefab 
{   

    public function onAfterCreateDashModelsEvents( $event )
    {   
        $mapper = $event->getArgument('mapper');
        
        
        
        $this->addDefaultRoles($mapper->event_id);
       // $this->addUsers($mapper->event_id);
       // $this->addAttendees($mapper->event_id);
       // $this->addTags($mapper->event_id);
        return $event;
    }


    protected function addDefaultRoles($eventid, $event_type = null) {

        
        $roles = array();
        $model = new \Dash\Models\Roles;
        $roles = $model->emptyState()->getList();
        \Base::instance()->set('eventid', $eventid);

      
        foreach ( $roles as $key => $role) {
         $newrole = (array) $role->cast();
         unset($newrole['_id']);
         $model = new \Dash\Models\Event\Roles;
         $model->create($newrole); 
        }   
    }

    protected function addUsers($eventid, $event_type = null) { 
       
         \Base::instance()->set('event.db', $eventid);
         $model = new \Dash\Models\Event\Users;
         $model->setIndexes();
    }
    protected function addAttendees($eventid, $event_type = null) { }
    protected function addTags($eventid, $event_type = null) { }

}