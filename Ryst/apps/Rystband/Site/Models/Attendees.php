<?php 
namespace Rystband\Site\Models;


Class Attendees Extends \Dash\Site\Models\Event\Attendees {

   
   
      public function getRandomItem( $refresh=false )
    {
        $filters = $this->getFilters();
        $options = $this->getOptions();
        
        $total = (int) $this->getTotal();
        $skip = rand(0,$total);

        $mapper = $this->getMapper();
        $options['limit'] = 1;
        if($skip !=0 || $skip !=1){
           $options['offset'] = $skip; 
        }
        
        $items = $mapper->find($filters, $options);
        if(@$items[0]){
             $item = $items[0];
            $item = $this->prepareItem($item);

        return $item;
        } else {
            return $items ;
        }

    }


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

    
} 
?>