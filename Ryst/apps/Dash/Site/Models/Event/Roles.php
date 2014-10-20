<?php 
namespace Dash\Site\Models\Event;


Class Roles Extends Eventbase {

    public $name;
    public $type;
    public $group;
    public $event;
  

    protected $__collection_name = 'users.roles';

   
    
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

        $filter_tagid = $this->getState('filter.tagid');
        
        if (strlen($filter_tagid))
        {
           $this->setCondition('tagid', $filter_tagid);
        }


        $filter_eventid = $this->getState('filter.eventid');

        if (strlen($filter_eventid))
        {
           $this->setCondition('eventid', $filter_eventid);
        }


        $filter_slug = $this->getState('filter.slug');

        if (strlen($filter_slug))
        {
           $this->setCondition('slug', $filter_slug);
        }

        
     
    
        return $this;
    }

  

}

?>