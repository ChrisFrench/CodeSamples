<?php 
namespace Dash\Site\Models\Event;

class Tags extends Eventbase 
{
   /**
     * Default Document Structure
     * @var unknown
     */

    public $_id;
    public $tagid;
    public $type = 'event';
    public $actions = array();
    public $attendee = array();
    public $ticket = array();
    public $eventhistory = array();
    public $event;
    protected $__chars = array('c','1','n','4','u','m','r','s','e','w','h','b','3','6','8','k','f','z','v','x','p','5','j','t','q','y','7','9','g','2','a','d');

    protected $__collection_name = 'rystbands';
    
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
            $this->setCondition('tagid', $key =  new \MongoRegex('/'. $filter_tagid .'/i'));
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

     function getTotalCount() {
        $this->emptyState();
        return $this->getTotal();
    }

    function withTicketsOnly() {
        $this->emptyState();
        $this->setState('filter.no.attendee', '1');
        $this->setState('filter.has.ticket', '1');
        return $this->getTotal();
    }

    function withAttendeesOnly() {
        $this->emptyState();
        $this->setState('filter.has.attendee', '1');
        $this->setState('filter.no.ticket', '1');
        return $this->getTotal();
    }

    function withAttendeesAndTickets() {
        $this->emptyState();
        $this->setState('filter.has.attendee', '1');
        $this->setState('filter.has.ticket', '1');
        return $this->getTotal();
    }

    function withNOAttendeesAndTickets() {
        $this->emptyState();
        $this->setState('filter.no.attendee', '1');
        $this->setState('filter.no.ticket', '1');
        return $this->getTotal();
    }

    function generateUUID($string = null) {
        //since event bands are all generated at once we don't want  all the bands at the event to be in a guessible order. 
        if(empty($string))  {
        //Check with frontend model so we don't get event.id check
         $band =  (new \Rystband\Site\Models\Tags)->setParam('sort', array('_id' => -1))->setCondition('sysgentag', 1)->fetchItem();    
         $last = $band->tagid;
        } else {
         $last = $string;
        }

        $length = strlen($last);
        
        //IF the entire string consists of all the last char in the array, add a row and repeat first char
        $match = "/^".end($this->__chars)."*$/";
        if (preg_match($match, $last)) { 
         return str_repeat($this->__chars[0], $length + 1);
        }

        $tagid = $this->updatePosition($last);
        
        $check = (new \Rystband\Site\Models\Tags)->setCondition('tagid',$tagid)->fetchItem();     

        if(!empty($check->_id)) {
        $tagid = $this->generateUUID($check->tagid);
        }
        
        return $tagid;

    }

    protected function updatePosition($last) {
        $exploded = str_split($last);
        $positions = array();
        // convert our characters to array positions of the chartater array
        foreach ($exploded as $value) {
            $positions[] = array_search($value, $this->__chars);
        }

        // now we need to calucatate the increase, 
        //so we add +1 to the last element and check if we need to increase going left.
        $keys = array_keys($positions);
        $currentKey =  end($keys); 
        $update = true;
        while ($update == true) {

          $positions[$currentKey]++;
      
          if($positions[$currentKey] == count($this->__chars))  {
            $positions[$currentKey] = 0;
            $currentKey--;
          } else {
             $update = false;
          }
        }
        //convert the positions back to a string
        $tagid = '';
        foreach ($positions as $key) {
             $tagid .= $this->__chars[$key];
        }
        return $tagid;
    } 


    protected function beforeSave()
    {
        if (empty($this->tagid))
        {
            $this->tagid = $this->generateUUID();
            $this->sysgentag = 1;
        }
        
        return parent::beforeSave();
    }

}