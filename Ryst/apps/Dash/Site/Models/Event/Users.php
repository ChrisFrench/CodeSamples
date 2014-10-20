<?php 
namespace Dash\Site\Models\Event;


Class Users Extends \Users\Models\Users {

    /**
     * Default Document Structure
     * @var unknown
     */


    public $company;


     public function populateState()
    {   
         $f3 = \Base::instance();

        $event = (new \Dash\Site\Models\Events)->setCondition('event_id', $f3->get('PARAMS.eventid'))->getItem();
        /* 
        TODO not sure if we set the state and let the models handle this or here and force it
        $this->setState('events.id',  $event->id);

         $filter_eventid = $this->getState('events.id');
        */
         
         $this->setCondition('events.id', new \MongoId((string) $event->id));   
        
        return  parent::populateState();
        
    }

    protected function fetchConditions()
    {   
        parent::fetchConditions();
        
        $filter_keyword = $this->getState('filter.keyword');
        if ($filter_keyword && is_string($filter_keyword))
        {
            $key =  new \MongoRegex('/'. $filter_keyword .'/i');
    
            $where = array();
            $where[] = array('username'=>$key);
            $where[] = array('email'=>$key);
            $where[] = array('first_name'=>$key);
            $where[] = array('last_name'=>$key);
    
            $this->setCondition('$or', $where);
        }
    
        $filter_id = $this->getState('filter.id');
        if (strlen($filter_id))
        {
            $this->setCondition('_id', new \MongoId((string) $filter_id));
        }
        
        $filter_username = $this->getState('filter.username', null, 'alnum');
        if (strlen($filter_username))
        {
            $this->setCondition('username', $filter_username);
        }
        
        $filter_username_contains = $this->getState('filter.username-contains', null, 'alnum');
        if (strlen($filter_username_contains))
        {
            $key =  new \MongoRegex('/'. $filter_username_contains .'/i');
            $this->setCondition('username', $key);
        }

        $filter_email = $this->getState('filter.email');
        if (strlen($filter_email))
        {
            $this->setCondition('email', $filter_email);
        }
        
        $filter_email_contains = $this->getState('filter.email-contains');
        if (strlen($filter_email_contains))
        {
            $key =  new \MongoRegex('/'. $filter_email_contains .'/i');
            $this->setCondition('email', $key);
        }

        $filter_password = $this->getState('filter.password');
        if (strlen($filter_password))
        {
            $this->setCondition('password', $filter_password);
        }

        $filter_group = $this->getState('filter.group');

        if (strlen($filter_group))
        {
            $this->setCondition('groups.id', new \MongoId((string) $filter_group) );
        }

    
        return $this;
    }
    
    protected function beforeValidate()
    {
        if (!empty($this->new_password))
        {
            if (empty($this->confirm_new_password))
            {
                $this->setError('Must confirm new password');
            }
        
            if ($this->new_password != $this->confirm_new_password)
            {
                $this->setError('New password and confirmation value do not match');
            }
        
            $this->password = password_hash( $this->new_password, PASSWORD_DEFAULT );
        }
        
        unset($this->new_password);
        unset($this->confirm_new_password);
        
        if (empty($this->password)) {
            $this->__auto_password = $this->generateRandomString( 10 ); // save this for later emailing to the user, if necessary
            $this->password = password_hash($this->__auto_password, PASSWORD_DEFAULT);
        }

        return parent::beforeValidate();
    }

    public function validate()
    {
        // if you want, use $this->validateWith( $validator ) here
        
        if (empty($this->email)) {
            $this->setError('Email is required');
        }
        
        if (empty($this->password)) {
            $this->setError('Password is required');
        }
        
        return parent::validate();
    }
    
    protected function beforeSave()
    {
       $f3 = \Base::instance();

        $events = array();

        if (!empty($this->roles)) 
        {
            $groups = array();
            foreach ($this->roles as $key => $id) 
            {
                $item = (new \Dash\Site\Models\Event\Roles)->setState('filter.id', $id)->getItem();
                $roles[] = array("id" =>  $item->id, "name" => $item->name);
        
            }
            $this->roles = $roles;
        }    
        //TODO fix it so if the event is not already stored in the attende it adds it
           if(!empty($this->events)) {
                    foreach ($this->events as $key => $event) 
                {   
                     $item = (new \Dash\Site\Models\Events)->setState('filter.id', $event['id'])->getItem();
                    $events[] = array("id" =>  $item->id, "name" => $item->name);
           
                }  
            } else {
                
                    $item = (new \Dash\Site\Models\Events)->setState('filter.eventid', $f3->get('PARAMS.eventid'))->getItem();
                    $events[] = array("id" =>  $item->id, "name" => $item->name);
            }
            
            $this->events = $events;
        
        return parent::beforeSave();
    }

}