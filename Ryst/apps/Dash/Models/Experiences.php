<?php 
namespace Dash\Models;

Class Experiences Extends \Dsc\Mongo\Collection  {

    public $_id;
    public $app;
    public $name;
    
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
  
            $this->setCondition('$or', $where);
            
        }
    
        $filter_id = $this->getState('filter.id');
        
        if (strlen($filter_id))
        {   
            $this->setCondition('_id', new \MongoId((string) $filter_id));
    
        }

       
     
        return $this;
    }


}

?>
