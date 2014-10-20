<?php
namespace Proposals\Admin\Models;

class Proposals extends \Dsc\Mongo\Collections\Taggable
{
    public $name;
    public $sales = array('first_name' => '', 'last_name' => '', 'title' => '', 'phone' => '', 'phone2' => '', 'email' => '');
    public $client = array('first_name' => '', 'last_name' => '', 'company' => '', 'title' => '', 'phone' => '', 'email' => '');
    public $event = array('name' => '', 'dates' => '', 'company' => '', 'title' => '', 'phone' => '', 'email' => '');
    //rystband - type, qty, price, customization, price, notes (small, large, etc)
    //smart station 
    //additional hardware
    //support

    protected $__collection_name = 'proposals';
    protected $__type = 'proposals';
    
    protected $__config = array(
        'default_sort' => array(
            'name' => 1
        )
    );

    protected function fetchConditions()
    {
        parent::fetchConditions();
        
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key = new \MongoRegex('/' . $filter_keyword . '/i');
            
            $where = array();
            $where[] = array(
                'name' => $key
            );
            
            $this->setCondition('$or', $where);
        }
        
        $filter_name = $this->getState('filter.name', null, 'alnum');
        if (strlen($filter_name))
        {
            $this->setCondition('name', $filter_name);
        }
        

        
        return $this;
    }

}