<?php 
namespace Dash\Site\Models\Event;


class Tickets extends Eventbase 
{
    protected $__collection_name = 'tickets';
   
 
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


        $filter_eventid = $this->getState('filter.eventid');

        if (strlen($filter_eventid))
        {
             $this->setCondition('eventid', $filter_eventid);
        }


        $filter_status = $this->getState('filter.status');

        if (strlen($filter_status))
        {
             $this->setCondition('status', $filter_status);
        }

         $filter_tag_id = $this->getState('filter.tag.id');

        if (strlen($filter_tag_id))
        {
             $this->setCondition('tag.id', new \MongoId((string)  $filter_tag_id));
        }

    
        return $this;
    }


     function getTotalCount() {
        $this->emptyState();
        return $this->getTotal();
    }

}

?>