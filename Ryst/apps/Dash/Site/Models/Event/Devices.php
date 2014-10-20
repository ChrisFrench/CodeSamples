<?php 
namespace Dash\Site\Models\Event;


Class Experiences Extends Eventbase {

    protected $__collection_name = 'experiences';
    
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
  
    
            $this->filters['$or'] = $where;
        }
    
        $filter_id = $this->getState('filter.id');
        
        if (strlen($filter_id))
        {
            $this->filters['_id'] = new \MongoId((string) $filter_id);
        }

        $filter_tagid = $this->getState('filter.tagid');
        
        if (strlen($filter_tagid))
        {
            $this->filters['tagid'] = $filter_tagid;
        }

         $filter_device_id = $this->getState('filter.device_id');
        
        if (strlen($filter_device_id))
        {
            $this->filters['device_id'] = $filter_device_id;
        }


        $filter_profile_complete = $this->getState('filter.profile.complete');

        if (strlen($filter_profile_complete))
        {
            $this->filters['first_name'] = array('$ne' => null);
            $this->filters['last_name'] = array('$ne' => null);
            $this->filters['phone'] = array('$ne' => null);
        }


        $filter_eventid = $this->getState('filter.eventid');

        if (strlen($filter_eventid))
        {
            $this->filters['eventid'] = $filter_eventid;
        }

        $filter_ticket_id = $this->getState('filter.ticket_id');

        if (strlen($filter_eventid))
        {
            $this->filters['ticket.id'] = $filter_ticket_id;
        }

        $filter_slug = $this->getState('filter.slug');

        if (strlen($filter_slug))
        {
            $this->filters['slug'] = $filter_slug;
        }

         $filter_first_name = $this->getState('filter.first_name');

        if (strlen($filter_first_name))
        {
            $this->filters['first_name'] = $filter_first_name;
        }

        $filter_last_name = $this->getState('filter.last_name');

        if (strlen($filter_last_name))
        {
            $this->filters['last_name'] = $filter_last_name;
        }

        $filter_phone = $this->getState('filter.phone');

        if (strlen($filter_phone))
        {
            $this->filters['phone'] = $filter_phone;
        }

        $filter_email = $this->getState('filter.email');

        if (strlen($filter_email))
        {
            $this->filters['email'] = $filter_email;
        }

        $filter_offers_sms = $this->getState('filter.offers.sms');
        
        if (strlen($filter_offers_sms))
        {
         $this->filters['offers.sms'] = (string) 'on';
        }

         $filter_offers_email = $this->getState('filter.offers.email');
        
        if (strlen($filter_offers_email))
        {
         $this->filters['offers.email'] = 'on';
        }
    
        return $this->filters;
    }


    public function getItem( $refresh=false )
    {
        $filters = $this->getFilters();
        $options = $this->getOptions();
    
        $mapper = $this->getMapper();
        $item = $mapper->findone($filters, $options);
        
        return $item;
    }


     public function getTotal()
    {
        
        $filters = $this->getFilters();
        $mapper = $this->getMapper();
        $count = $mapper->count($filters);
    
        return $count;
    }

    function getTotalCount() {
        $this->emptyState();
        return $this->getTotal();
    }


    public function createDevice($uid) {

        $array = array('device' => 'auto created '.$uid,  'device_id' => $uid);
        $this->create($array);

    }

   

}

?>
