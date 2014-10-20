<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Magic extends \Rystband\Site\Controllers\Event\Base
{

    
    public function magic($f3)
    {
        $identity = $this->getIdentity();
        if (empty($identity->id))
        {

          $user = (new \Users\Models\Users)->setCondition('email', 'admin@bellevent.com')->getItem();
          //$this->setIdentity($user);
	         $this->session->set('auth-identity', $user);
          //attendee
          $f3->reroute('/montreal/active/role/536abec523195aadca0041a7');
        } else {
          //attendee
          $f3->reroute('/montreal/active/role/536abec523195aadca0041a7');
        }
       


    }

  

}
