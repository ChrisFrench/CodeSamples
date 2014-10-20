<?php 

class DasRoles extends \Prefab 
{
   
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
