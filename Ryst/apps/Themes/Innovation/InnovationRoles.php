<?php 

class InnovationRoles extends \Prefab 
{
    public function role_attendee_registration( $event )
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
          echo $view->render('Rystband/Site/Views::event/employee/register/already.php');
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

   /* public function afterCreateRystbandSiteModelsAttendees( $event )
    {
        $doc = $event->getArgument('model');
        $model = new \Rystband\Site\Models\Attendees;
        //LETS query the database to see if need to sync this data with a user from the mysql database
        $db = new \DB\SQL('mysql:host=127.0.0.1;port=3306;dbname=attendee','root','F0rgetting01');
        $attendee=$db->exec("SELECT * FROM attendees WHERE email = '$doc->email' LIMIT 1");
        if(!empty($attendee[0])) {
          $firstname = $doc->first_name;
          foreach ($attendee[0] as $key => $value) {
            $doc->set($key,$value);
          }
          $doc->synced = true;
          $doc->first_name = $firstname;
          $doc->save();
        } else {
          //what do we do here if no one to sync?
        }
    }
*/




}
