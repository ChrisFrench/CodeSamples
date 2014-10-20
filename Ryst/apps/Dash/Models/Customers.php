<?php 
namespace Dash\Models;

class Customers extends \Dsc\Mongo\Collection 
{
    /**
     * Default Document Structure
     * @var unknown
     */
    public $_id;
    public $name;
    public $subdomain;
    public $address;
    public $phone;
    public $logo;
    public $url;
    
    protected $__collection_name = 'customers';
    
    protected function fetchConditions()
    {   
        parent::fetchConditions();
        
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key =  new \MongoRegex('/'. $filter_keyword .'/i');
    
            $where = array();
            $where[] = array('name'=>$key);
            $where[] = array('email'=>$key);
           
    
            $this->setCondition('$or', $where);
        }
    
        $filter_id = $this->getState('filter.id');
        if (strlen($filter_id))
        {
            $this->setCondition('_id', new \MongoId((string) $filter_id));
        }
        
        $filter_name = $this->getState('filter.name', null, 'alnum');
        if (strlen($filter_name))
        {
            $this->setCondition('name', $filter_name);
        }
        
        $filter_name_contains = $this->getState('filter.name-contains', null, 'alnum');
        if (strlen($filter_name_contains))
        {
            $key =  new \MongoRegex('/'. $filter_name_contains .'/i');
            $this->setCondition('name', $key);
        }
        
        $filter_email_contains = $this->getState('filter.email-contains');
        if (strlen($filter_email_contains))
        {
            $key =  new \MongoRegex('/'. $filter_email_contains .'/i');
            $this->setCondition('email', $key);
        }

         $filter_email = $this->getState('filter.email', null, 'string');
        if (strlen($filter_email))
        {
            $this->setCondition('email', $filter_email);
        }
    
       
        return $this;
    }
    
    protected function beforeValidate()
    {
        
        return parent::beforeValidate();
    }

    public function validate()
    {
        // if you want, use $this->validateWith( $validator ) here
        
      /*  if (empty($this->email)) {
            $this->setError('Email is required');
        }*/
       
        
        return parent::validate();
    }
    
    public function beforeSave()
    {
       /* if (empty($this->name)) {
            $this->name = $this->email;
        }        
        
        $this->name = \Dsc\System::instance()->inputfilter->clean( $this->name, 'ALNUM' );

        if (!empty($this->groups)) 
        {
            $groups = array();
            foreach ($this->groups as $key => $id) 
            {
                $item = (new \Dash\Site\Models\Groups)->setState('filter.id', $id)->getItem();
                $groups[] = array("id" =>  $item->id, "name" => $item->name);
        
            }
            $this->groups = $groups;
        }   
        */     
        
        return parent::beforeSave();
    }

  
}
