<?php
namespace ZDas\Site\Controllers;

class Vipregister extends Base
{
  	public function login() {
  		$key = $this->app->get('PARAMS.key');
  		$channel = $this->app->get('PARAMS.channel');
  		
  		if($key == 'v22014') {
  		$user = (new \Users\Models\Users)->setState('filter.id', '53deb51e13ec0222528b457c')->getItem();	
  		$this->auth->setIdentity($user);
  		$this->session->set('channel', $channel);
  		$this->session->set('active_role', 'das_attendee_vipregistration');
  		$this->app->reroute('/das/vipregister/tapper');
  			
  			} else {
  			//something went wrong
  		}
  		
  	}
  	
  	public function tapper() {
  		
  		echo $this->theme->setVariant('vipregister')->render('ZDas/Site/Views::tapper/index.php');
  	
  	}
  	
  	public function scanner() {
  		$this->app->set('channel', $this->app->get('PARAMS.channel'));
  		 
  		echo $this->theme->setVariant('vipregister')->render('ZDas/Site/Views::scanner/index.php');
  	}
 
    public function index()
    {
        $this->app->set('meta.title', 'Enter Barcode From Tag');
        
        echo $this->theme->setVariant('vipregister')->render('ZDas/Site/Views::barcode/index.php');
    }
    
    //register a band to a person
    public function doRegister() {
    
    	$tag = $this->validateTag($this->app->get('POST.bandid'));
    	$redirect = \Dsc\System::instance()->get('session')->get('barcoderedirect');
    	
    	// save
    	try {
    		$model = new \Rystband\Site\Models\Attendees;
    		$model->setEvent($tag->{'event.id'});
    
    		$inputfilter = new \Joomla\Filter\InputFilter;
    		$data = \Base::instance()->get('REQUEST');
    		$data['tagid'] = $tag->id;
    		$item = $model->create($data);
    
    
    		$tag->set('attendee.id',$item->id);
    		$tag->set('attendee.name',$item->first_name . ' ' . $item->last_name);
    		$tag->save();
    
    		if($item->id) {
    			//todo make a get/setIdentity method like f3-users users
    			\Dsc\System::instance()->get( 'session' )->set( 'attendee', $item );
    			\Dsc\System::instance()->get( 'session' )->set( 'home', '/b/'. $tag->tagid );
    			if($redirect) {
    				$this->app->reroute($redirect);
    			} else {
    				$this->app->reroute('/b/'.$tag->tagid);
    			}
    			
    		}
    
    		//if created set the auth and than  redirect back to their band url
    
    	}
    	catch (\Exception $e) {
    
    	}
    
    
    
    }
    
    
    protected function validateTag($tagid = null) {
    
    	$model = new \Rystband\Site\Models\Tags;
    	$model->setState('filter.tagid', $tagid);
    	$tag = $model->getItem();
    
    	//TODO do some checks on this tag to make sure we can register/ now we can redirect
    
    
    	return $tag;
    
    }
    
}