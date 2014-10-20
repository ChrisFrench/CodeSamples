<?php 
namespace ZDas\Site\Controllers;

class Das extends Base 
{
   
	 public function tap() {
	 	
	 	echo $this->theme->render('ZDas/Site/Views::tap/index.php');
	 	 
	 }
		
	 function watchChannel() {
	 	
	 	$this->session->set('tapchannel', $this->app->get('PARAMS.channel') );
	 	 
	 	$this->app->reroute('/das/tap');
	 	
	 }
	 
	 function survey() {
	 
	 	\Dsc\System::instance()->get('theme')->setTheme('V2', $this->app->get('PATH_ROOT') . 'apps/Themes/V2/' );
	 	\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Themes/V2/Views/', 'Themes/V2/Views' );
	 	\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/ZDas/Site/Views/', 'ZDas/Site/Views' );
	 	
	 	
	 	$tagid = $this->app->get('PARAMS.tagid');
	 
	 	$tag = (new \Rystband\Site\Models\Tags)->setState('filter.tagid',(string) $tagid)->getItem();
	 	
	 	$attendee = (new \Rystband\Site\Models\Attendees)->setState('filter.id', $tag->{'attendee.id'})->getItem();
	 
	 	$this->app->set('attendee',$attendee);
	 	$this->app->set('tag',$tag);
	 	
	 	echo $this->theme->render('ZDas/Site/Views::profile/survey.php');
	 		
	 }
	 
	 function surveySave() {
	 	
	 	$tagid = $this->app->get('POST.tagid');
	 	
	 	$tag = (new \Rystband\Site\Models\Tags)->setState('filter.tagid',(string) $tagid)->getItem();
	 	$attendee = (new \Rystband\Site\Models\Attendees)->setState('filter.id', $tag->{'attendee.id'})->getItem();
	 	
	  	$data = $this->input->getArray();
	  	unset($data['tagid']);
	  	unset($data['actor_id']);
	  	
	  	foreach($data  as $key => $value)  {
	  		$attendee->set($key, $value);
	  	}
	  	$attendee->save();
	  	
	 	
	 	
	 	$this->app->reroute('http://ryst.cc/i/'.$tagid.'?saved=1');
	 	
	 
	 }
	 
	 function photobooth() {
	 	\Dsc\System::instance()->get('theme')->setTheme('V2', $this->app->get('PATH_ROOT') . 'apps/Themes/V2/' );
	 	\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/Themes/V2/Views/', 'Themes/V2/Views' );
	 	\Dsc\System::instance()->get('theme')->registerViewPath( $this->app->get('PATH_ROOT')  . 'apps/ZDas/Site/Views/', 'ZDas/Site/Views' );
	 	 
	 	
	 	echo $this->theme->render('ZDas/Site/Views::photobooth/index.php');
	 	 
	 }
}	
