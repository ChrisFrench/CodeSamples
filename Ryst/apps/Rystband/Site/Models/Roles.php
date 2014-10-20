<?php 
namespace Rystband\Site\Models;

class Roles extends Eventbase 
{
    
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
    
            $this->setCondition('$or', $where);
        }
    
        $filter_id = $this->getState('filter.id');
        
        if (strlen($filter_id))
        {
            $this->setCondition('_id', new \MongoId((string) $filter_id));
        }
    
        return $this;
    }

    
    public function create($document=array(), $options=array())
    {
       //This model can not create tags
    }
    

}
?>