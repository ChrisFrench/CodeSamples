<?php 
namespace Dash\Site\Models\Event;

Class Experiences Extends Eventbase {

    public $_id;
    public $name;
    public $device_id;

    protected $__collection_name = 'event.experiences';
    
    protected function fetchConditions()
    {   
        parent::fetchConditions();
       
       
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key =  new \MongoRegex('/'. $filter_keyword .'/i');
    
            $where = array();
            $where[] = array('name'=>$key);
            $where[] = array('slug'=>$key);
            $where[] = array('event_id'=>$key);
            $where[] = array('start_date'=>$key);
            $where[] = array('end_date'=>$key);
  
            $this->setCondition('$or', $where);
            
        }
    
        $filter_id = $this->getState('filter.id');
        
        if (strlen($filter_id))
        {   
            $this->setCondition('_id', new \MongoId((string) $filter_id));
    
        }

        $filter_device_id = $this->getState('filter.device_id');
        
        if (strlen($filter_device_id))
        {
            $this->setCondition('device_id', $filter_device_id);
        }

        $filter_event_id = $this->getState('filter.event_id');
        
        if (strlen($filter_event_id))
        {
            $this->setCondition('event.id', new \MongoId((string) $filter_event_id));
        }


     
        return $this;
    }


}

?>
