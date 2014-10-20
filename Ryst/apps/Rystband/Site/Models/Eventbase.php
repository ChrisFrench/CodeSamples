<?php 
namespace Rystband\Site\Models;

class Eventbase extends \Dash\Site\Models\Event\Eventbase   
{
   
     public function populateState()
    {   
         $f3 = \Base::instance();

        //$event = (new \Dash\Site\Models\Events)->setCondition('event_id', $f3->get('PARAMS.eventid'))->getItem();
        

        /* 
        TODO not sure if we set the state and let the models handle this or here and force it
        $this->setState('events.id',  $event->id);

         $filter_eventid = $this->getState('events.id');
        */

       //  $this->setCondition('event.id', new \MongoId((string) $event->id));   
        
      //  return  parent::populateState();
        
    }

     protected function beforeSave()
    {   
            $f3 = \Base::instance();

      //      if(empty($this->eventid)) {
      //          $item = (new \Dash\Site\Models\Events)->setState('filter.eventid', $f3->get('PARAMS.eventid'))->getItem();
      //      } else {
       //         $item = (new \Dash\Site\Models\Events)->setState('filter.id', $this->eventid)->getItem();

       //     }
       //     $this->event = array("id" =>  $item->id, "name" => $item->name);

        return parent::beforeSave();
    }
}
?>