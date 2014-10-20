<?php 
namespace Dash\Site\Models;

//Sets some company specific states automatically
class Company extends \Dash\Site\Models\Base   
{
    protected $db = null; // the db connection object
    

    public function populateState()
    {   
        $customer = \Dsc\System::instance()->get( 'session' )->get( 'customer');
        
        $this->setCondition('company.id',  $customer->id);

        return  parent::populateState();
        
    }

    protected function beforeSave()
    {   

        if(empty($this->company_id)) {
            $customer =  \Dsc\System::instance()->get( 'session' )->get( 'customer');
            $this->company = array('id'=> $customer->id, 'name' => $customer->name);
            \Dsc\System::instance()->get( 'session' )->set( 'customer', $customer );
        }
        
        return parent::beforeSave();
    }
    
}
?>