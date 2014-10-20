<?php 
namespace ZDas\Site\Controllers;

class Register extends Base 
{	
	protected function validateTag($tagid = null) {
	
		$model = new \Rystband\Site\Models\Tags;
		$model->setState('filter.tagid', $tagid);
		$tag = $model->getItem();
	
		//TODO do some checks on this tag to make sure we can register/ now we can redirect

		return $tag;
	
	}
   
	 public function doRegister() {
	 	
	 	$tagid = $this->app->get('POST.tagid');
	 	
	 	$tag = $this->validateTag($tagid);
	 	//GET THE USER
	 	$user = (new \Rystband\Site\Models\Attendees)->setState('filter.id', $this->app->get('POST.user'))->getItem();
	 	if(!empty($user->id)) {
	 		
	 		$user->set('tagid', $tagid);
	 		$user->save();
	 		
	 		$tag->set('attendee.id',$user->id);
            $tag->set('attendee.name',$user->first_name . ' ' . $user->last_name);
            $tag->save();
           
	 		$this->app->reroute('/user/'.$user->id);
	 	}
	 	
	 }

}
