<?php 
namespace ZDas;

class Listener extends \Prefab 
{
    public function onSystemRebuildMenu( $event )
    {
		if ($model = $event->getArgument('model'))
		{
			$root = $event->getArgument( 'root' );
			$proposals = clone $model;
        		 
			$proposals->insert(
					array(
						'type'	=> 'admin.nav',
						'priority' => 50,
						'title'	=> 'Proposals',
						'icon'	=> 'fa fa-user',
        				'is_root' => false,
						'tree'	=> $root,
						'base' => '/admin/proposals',
					)
				);
        	
			$children = array(
        			array( 'title'=>'List', 'route'=>'/admin/proposals', 'icon'=>'fa fa-user' ),
              		
        	        array( 'title'=>'Settings', 'route'=>'/admin/proposals/settings', 'icon'=>'fa fa-cogs' ),
			);
       		$proposals->addChildren( $children, $root );
        	
        	\Dsc\System::instance()->addMessage('Proposals added its admin menu items.');
        }
        
    }
    
    public function role_das_attendee_registration( $event )
    {
    	$tag = $event->getArgument('tag');
    	\Dsc\System::instance()->get( 'session' )->set( 'tagid', $tag->tagid);
    	if(empty($tag->attendee)) {
    		$view = \Dsc\System::instance()->get( 'theme' );
    		echo $view->render('Rystband/Site/Views::event/employee/register/form.php');
    	} else {
    		$model = new \Rystband\Site\Models\Attendees;
    		$attendee = $model->setCondition('_id',  new \MongoId((string) $tag->{'attendee.id'}))->getItem();
    		\Base::instance()->set('attendee', $attendee);
    		$view = \Dsc\System::instance()->get( 'theme' );
    		echo $view->render('Rystband/Site/Views::event/employee/attendee/profile.php');
    	}
    }
    
    public function role_das_attendee_vipregistration( $event )
    {
    	
    	$tag = $event->getArgument('tag');
    		
    	\Dsc\System::instance()->get( 'session' )->set( 'tagid', $tag->tagid);

	    	if(empty($tag->attendee)) {
	    		$channel = \Dsc\System::instance()->get( 'session' )->get( 'channel');
    		
    		$settings = \Pusher\Models\Settings::fetch();
    		$pusher =   new \Pusher\Pusher($settings->{'pusher.key'}, $settings->{'pusher.secret'}, $settings->{'pusher.app_id'});
    		
    		$app = \Base::instance();
    		
    		$pusher->trigger( $channel, 'tapped', array('bandid' => $tag->tagid));
    			
    		\Dsc\System::addMessage('Sent Band ID "'. $tag->tagid. '" To scanner');
    		
    		$app->reroute('/das/vipregister/tapper');
    			} else {
    				$model = new \Rystband\Site\Models\Attendees;
    				$attendee = $model->setCondition('_id',  new \MongoId((string) $tag->{'attendee.id'}))->getItem();
    				\Base::instance()->set('attendee', $attendee);
    		$view = \Dsc\System::instance()->get( 'theme' );
    				echo $view->render('Rystband/Site/Views::event/employee/register/already.php');
    		//already registerd
    		
    		
    		}
    }
    
    public function role_experience_dispatcher( $event )
    {
    
    	$tag = $event->getArgument('tag');
    
    	$experience_uid = \Dsc\System::instance()->get( 'session' )->get( 'experience_uid');
    
    	if(empty($experience_uid)) {
    		//return the list of $experiences with warning of being empty
    		(new \Rystband\Site\Controllers\Event\Employee\Experiences)->index();
    
    	} else {
    		//OK so the logged in user, as an active role to act as a smart station, and has set their UID lets fake a tap
    		//(new \Crossbox\Site\Controllers\Device)->systap($tag->tagid, $experience_uid, time());
    
    		$f3 = \Base::instance();
    
    
    		//LOAD THE EVENT
    		$event = (new \Dash\Site\Models\Events)->setState('filter.id',$tag->{'event.id'})->getItem();
    
    		// OK so we have the event we can now load the Experiences for this box
    		$experience = (new \Dash\Site\Models\Event\Experiences)->setState('filter.device_id', $experience_uid )->setState('filter.event_id',$event->id)->getItem();
    		 
    		//Pass the information over to the Experiences Launcher
    		$controller = new \Rystband\Site\Controllers\Experience;
    		$controller->launch($experience, $event, $tag);
    
    
    
    	}
    
    	/* if(empty($tag->attendee)) {
    	 $view = \Dsc\System::instance()->get( 'theme' );
    	echo $view->render('Rystband/Site/Views::event/employee/gatekeeper/register.php');
    	} else {
    	$model = new \Rystband\Site\Models\Attendees;
    	$attendee = $model->setCondition('_id',  new \MongoId((string) $tag->{'attendee.id'}))->getItem();
    	\Base::instance()->set('attendee', $attendee);
    	$view = \Dsc\System::instance()->get( 'theme' );
    	echo $view->render('Rystband/Site/Views::event/employee/register/already.php');
    	} */
    
    }
    
    
    public function role_event_attendance( $event )
    {
    
    	$tag = $event->getArgument('tag');
    	\Dsc\System::instance()->get( 'session' )->set( 'tagid', $tag->tagid);
    
    	if(empty($tag->attendee)) {
    		$view = \Dsc\System::instance()->get( 'theme' );
    		echo $view->render('Rystband/Site/Views::event/employee/gatekeeper/register.php');
    
    	} else {
    		$model = new \Rystband\Site\Models\Attendees;
    		$attendee = $model->setCondition('_id',  new \MongoId((string) $tag->{'attendee.id'}))->getItem();
    		\Base::instance()->set('attendee', $attendee);
    		$view = \Dsc\System::instance()->get( 'theme' );
    		echo $view->render('Rystband/Site/Views::event/employee/register/already.php');
    	}
    }
    
    
}