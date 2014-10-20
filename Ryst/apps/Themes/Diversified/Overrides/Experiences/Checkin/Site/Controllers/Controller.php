<?php 

class ControllerOverride extends \Experiences\Checkin\Site\Controllers\Controller 
{   
        
      
  function launch($tag, $event, $experience) {

       if(empty($tag)) {
              echo 'This band has no wristband tag in the tags collection'. "\n";
              return;
        }

        $attendee = null;
        $f3 = \Base::instance();
        if(!empty($tag->{'attendee.id'})) {
          $attendees = new \ Dash\Site\Models\Event\Attendees;
          $attendees->setState('filter.id', $tag->{'attendee.id'});
          $attendee = $attendees->getItem();
        }

        $time =  \Dsc\System::instance()->get('session')->get('checkin.time');
        if($time) {
          $date = new \DateTime();
          $date->setTimezone(new \DateTimeZone($event->event_time_zone));
          $date->setTimestamp($time);
        } else {
          $date = new \DateTime();
          $date->setTimezone(new \DateTimeZone($event->event_time_zone));
        }


        //get the session from the MYSQL DB
        // $db = new \DB\SQL('mysql:host=127.0.0.1;port=3306;dbname=ryst','root','F0rgetting01');
        //$attendee=$db->exec("SELECT * FROM attendees WHERE email = '$doc->email' LIMIT 1");
        //if(!empty($attendee[0])) {
         
        
         $checkins =  $experience->checkins;
         $date = new \DateTime();
         $checkins[] = array('id' =>  $attendee->id, 'name'=> $attendee->first_name .' '. $attendee->last_name, 'time' => $date->format('Y-m-d H:i:s'));
         $experience->checkins = $checkins;
         $experience->save();
        
         $f3->set('tag',$tag);
         $f3->set('event',$event);
         $f3->set('experience',$experience);
         $f3->set('attendee',$attendee);
        


         switch ($experience->device_id) {
           
            //Phoenix A
           case '0000d212ebb5':
              //key note
              $email = array('contact' => '',
               'session_name' => 'Opening Keynote Presentation: Unified Data Centre - Delivering an Application Centric Infrastructure',
               'contact_email' => '',
               'company' => 'Cisco Systems Canada',
              'website' => 'http://www.cisco.com/ca' );

               /*$email = array(
               'starttime' => '9:30 AM', 
               'session_name' => 'Demystifying Dark Data',
               'contact' => 'Rich Brown',
               'contact_email' => 'rbrown@commvault.com',
               'company' => 'Commvault',
              'website' => 'www.commvault.com' 
              );*/
                
                /*$email = array(
               'starttime' => '10:30 AM', 
               'session_name' => 'Why hypervisor convergence and ServerSANs are replacing traditional shared storage',
               'contact' => 'Dave Demlow',
               'contact_email' => 'ddemlow@scalecomputing.com',
               'company' => 'Scale Computing, Inc.',
              'website' => 'www.scalecomputing.com' 
              );*/

              /*$email = array(
               'starttime' => '1:00 PM', 
               'session_name' => 'Customer Case Study: Data Center Disaster Recovery',
               'contact' => '',
               'contact_email' => '',
               'company' => 'Cisco Systems Canada ',
              'website' => 'http://grs.cisco.com/grsx/cust/grsCustomerSurvey.html?SurveyCode=4547&KeyCode=198112_1' 
              );*/
              /*$email = array(
               'starttime' => '2:00 PM', 
               'session_name' => 'CompTIA: Quick Start Session to Business Continuity and Data Recovery',
               'contact' => 'Denise Woods-Goldstein',
               'contact_email' => 'DWoods@comptia.org',
               'company' => 'CompTIA',
              'website' => 'www.comptia.org' 
              );*/
              /*$email = array(
               'starttime' => '2:45 PM', 
               'session_name' => 'When Minutes Matter: Instantly Restore IT Function When They Go Down',
               'contact' => 'Tyler Buzalsky',
               'contact_email' => 'Tyler.Buzalsky@Quorum.net',
               'company' => 'Quorum',
              'website' => 'www.quorum.net' 
              );*/

  //last one
  /*$email = array(
               'starttime' => '3:45 PM', 
               'session_name' => 'Closing Keynote Presentation: Enterprise Needs More Than Email: Enable Cross-Platform Apps',
               'contact' => 'Lee Van Cromvoirt',
               'contact_email' => 'lvancromvoirt@blackberry.com',
               'company' => 'BlackBerry',
              'website' => 'www.blackberry.com' 
              );*/



             break;
             //Phoenix B
           case '00008dd18ca2':
              //key note
             $email = array('contact' => '',
               'session_name' => 'Opening Keynote Presentation: Unified Data Centre - Delivering an Application Centric Infrastructure',
               'contact_email' => '',
               'company' => 'Cisco Systems Canada',
              'website' => 'http://www.cisco.com/ca' );



              /*$email = array(
               'starttime' => '9:30 AM', 
               'session_name' => 'Modern Data Protection Build for Virtualization, using the right tool for the job',
               'contact' => 'James Hernandez',
               'contact_email' => 'james.hernandez@veeam.com',
               'company' => 'Veeam Software',
              'website' => 'www.veeam.com' 
              );*/
              
               /*$email = array(
               'starttime' => '10:30 AM', 
               'session_name' => 'Common pit-falls and 'gotchas' to avoid when building your own highly-available virtual machine cluster',
               'contact' => 'Dennis Mansillo',
               'contact_email' => 'dennis@alteeve.ca',
               'company' => 'Alteeves's Niche!',
              'website' => 'alteeve.ca/c/' 
              );*/

               /*$email = array(
               'starttime' => '11:15 AM', 
               'session_name' => 'We Adapt, You Succeed',
               'contact' => 'Sean Rickerd',
               'contact_email' => 'srickerd@suse.com',
               'company' => 'Suse',
              'website' => 'www.suse.com' 
              );*/

               /*$email = array(
               'starttime' => '1:00 PM', 
               'session_name' => 'What is hypervisor convergence? How converged systems like Scale Computing HC3 can radically simplify IT infrastructure management',
               'contact' => 'Dave Demlow',
               'contact_email' => 'ddemlow@scalecomputing.com',
               'company' => 'Scale Computing, Inc.',
              'website' => 'www.scalecomputing.com' 
              );*/

               /*$email = array(
               'starttime' => '2:00 PM', 
               'session_name' => 'The Evolution of Opensource Technologies',
               'contact' => 'Sean Rickerd',
               'contact_email' => 'srickerd@suse.com',
               'company' => 'Suse',
              'website' => 'www.suse.com' 
              );*/
              
               /*$email = array(
               'starttime' => '2:45 PM', 
               'session_name' => 'Virtualizing your Datacenter with Hyper-V 2012 R2',
               'contact' => 'Anthony Bartolo',
               'contact_email' => 'cdniblog@microsoft.com',
               'company' => 'Microsoft',
              'website' => 'www.canitpro.net' 
              );*/



               //last one
  /*$email = array(
               'starttime' => '3:45 PM', 
               'session_name' => 'Closing Keynote Presentation: Enterprise Needs More Than Email: Enable Cross-Platform Apps',
               'contact' => 'Lee Van Cromvoirt',
               'contact_email' => 'lvancromvoirt@blackberry.com',
               'company' => 'BlackBerry',
              'website' => 'www.blackberry.com' 
              );*/
             break;  
            //Phoenix C
           case '0000123c723a':
             
             //last one
             $email = array(
               'starttime' => '9:30 AM', 
               'session_name' => 'Test your knowledge in Cloud Computing with ORSYP Trivial Pursuit™!',
               'contact' => 'Dilara Buyuk',
               'contact_email' => 'dilara.buyuk@orsyp.com',
               'company' => 'ORSYP Software',
              'website' => 'www.orsyp.com' 
              );

            /*$email = array(
               'starttime' => '10:30 AM', 
               'session_name' => 'Leveraging the Cloud to Detect Insider Threats',
               'contact' => 'Kevin Hosey',
               'contact_email' => 'khosey@seccuris.com',
               'company' => 'Seccuris',
              'website' => 'www.seccuris.com' 
              );*/

              /*$email = array(
               'starttime' => '11:15 AM', 
               'session_name' => 'Building a cloud? Learn about the implications for Storage.',
               'contact' => '',
               'contact_email' => '',
               'company' => 'IBM',
              'website' => 'www.ibm.com' 
              );*/

            /*$email = array(
               'starttime' => '1:00 PM', 
               'session_name' => 'Transform Your Application Development with a Code-less Cloud Platform',
               'contact' => 'Sabina Tuladhar',
               'contact_email' => 'sabina.tuladhar@caspio.com',
               'company' => 'Caspio',
              'website' => 'www.caspio.com' 
              );*/
            
               /*$email = array(
               'starttime' => '2:00 PM', 
               'session_name' => 'Introducing Cloud to your Business',
               'contact' => 'Joe Damiani',
               'contact_email' => 'jdamiani@rogers.com',
               'company' => 'Skyrider Consulting',
              'website' => '' 
              );*/
            
             /*$email = array(
               'starttime' => '2:45 PM', 
               'session_name' => 'CompTIA: Trends in Cloud Computing',
               'contact' => 'Denise Woods-Goldstein',
               'contact_email' => 'DWoods@comptia.org',
               'company' => 'CompTIA',
              'website' => 'www.comptia.org' 
              );*/
             break;
             //Lyra B
            case '000072921ab1':

             $email = array(
               'starttime' => '9:30 AM', 
               'session_name' => 'Why Infrastructure Matters',
               'contact' => '',
               'contact_email' => '',
               'company' => 'IBM',
              'website' => 'www.ibm.com' 
              );

           /*  $email = array(
               'starttime' => '10:30 AM', 
               'session_name' => 'Creating a Zero Downtime Datacentre',
               'contact' => 'Sean Rickerd',
               'contact_email' => 'srickerd@suse.com',
               'company' => 'Suse',
              'website' => 'www.suse.com' 
              );*/

             /* $email = array(
               'starttime' => '11:15 AM', 
               'session_name' => 'Recognizing the 7 Stages of Advanced Threats & Data Theft',
               'contact' => 'Brent Shelp',
               'contact_email' => 'bshelp@websense.com',
               'company' => 'Websense',
              'website' => 'www.websense.com' 
              );*/

             /*  $email = array(
               'starttime' => '1:00 PM', 
               'session_name' => 'How Mission Critical Cloud Can Help Drive Your Ecommerce Business',
               'contact' => 'Luigi Marshall',
               'contact_email' => 'lmarshall@peer1.com',
               'company' => 'Peer1',
              'website' => 'www.peer1.ca' 
              );*/

               /*  $email = array(
               'starttime' => '2:00 PM', 
               'session_name' => 'CompTIA: Quick Start Session to Security Compliance',
               'contact' => 'Denise Woods-Goldstein',
               'contact_email' => 'DWoods@comptia.org',
               'company' => 'CompTIA',
              'website' => 'www.comptia.org' 
              );*/

               /*  $email = array(
               'starttime' => '2:45 PM', 
               'session_name' => 'The Influence of Web-Scale IT on the Enterprise',
               'contact' => 'Chris Coburn',
               'contact_email' => 'ccoburn@nutanix.com',
               'company' => 'Nutanix',
              'website' => 'www.nutanix.com' 
              );*/  






             break;
            //Lyra A
            case '0000d238082e':
             $email = array(
               'starttime' => '9:30 AM', 
               'session_name' => 'The Rise of Tablets as Business Devices',
               'contact' => 'Kevin Graham',
               'contact_email' => 'k.graham@samsung.com',
               'company' => 'Samsung',
              'website' => 'http://www.samsung.com/business' 
              );
             /*$email = array(
               'starttime' => '10:30 AM', 
               'session_name' => 'Building for the Enterprise with Cross-Platform Apps',
               'contact' => 'Lee Van Cromvoirt',
               'contact_email' => 'lvancromvoirt@blackberry.com',
               'company' => 'BlackBerry',
              'website' => 'http://www.blackberry.com' 
              );*/
            /*$email = array(
               'starttime' => '11:15 AM', 
               'session_name' => 'The Elastic Network: Turning Connectivity into Competitive Advantage',
               'contact' => 'Kevin Grellette',
               'contact_email' => 'kgrellette@bluecatnetworks.com',
               'company' => 'BlueCat',
              'website' => 'www.bluecatnetworks.com/networkintelligence' 
              ); */
            /*$email = array(
               'starttime' => '1:00 PM', 
               'session_name' => 'Enterprise Security and Samsung KNOX',
               'contact' => 'Kevin Graham',
               'contact_email' => 'k.graham@samsung.com',
               'company' => 'Samsung',
              'website' => 'www.samsung.com/business' 
              );*/
            /*$email = array(
               'starttime' => '2:45 PM', 
               'session_name' => "Ensure Your Wan isn't the bottleneck for your cloud, VDI,or Replication, Applications.",
               'contact' => 'Paul Chan',
               'contact_email' => 'paul.chan@storageflex.com',
               'company' => 'Storageflex Inc',
              'website' => 'www.storageflex.com' 
              );*/
            
             break;       
            //Pegasus A
            case '000014b96af4':
            
            $email = array(
               'starttime' => '9:30 AM', 
               'session_name' => "Empowering People Centric IT",
               'contact' => 'Anthony Bartolo',
               'contact_email' => 'cdniblog@microsoft.com',
               'company' => 'Microsoft',
              'website' => 'www.canitpro.net' 
              );

             /* $email = array(
               'starttime' => '10:30 AM', 
               'session_name' => "The Power of Influence Jocelyn Bérard",
               'contact' => 'Andrew Ford',
               'contact_email' => 'andrew.ford@globalknowledge.com',
               'company' => 'Global Knowledge',
              'website' => 'www.globalknowledge.ca' 
              );*/

              /*$email = array(
               'starttime' => '11:15 AM', 
               'session_name' => "CompTIA: Elevate your IT Career and Overcome the Skills Gap",
               'contact' => 'Denise Woods-Goldstein',
               'contact_email' => 'DWoods@comptia.org',
               'company' => 'CompTIA',
              'website' => 'www.comptia.org' 
              );*/

               /*$email = array(
               'starttime' => '1:00 PM', 
               'session_name' => "CompTIA: Considering the Move to Managed IT Services",
               'contact' => 'Denise Woods-Goldstein',
               'contact_email' => 'DWoods@comptia.org',
               'company' => 'CompTIA',
              'website' => 'www.comptia.org' 
              );*/

               /*$email = array(
               'starttime' => '2:00 PM', 
               'session_name' => "Dynamic Communication for IT Professionals",
               'contact' => 'Claudia Ferryman',
               'contact_email' => 'cfrainmaker@aol.com',
               'company' => 'Rainmaker Strategies Group',
              'website' => 'www.rainmakerstrategies.org' 
              );*/

           /*$email = array(
               'starttime' => '2:45 PM', 
               'session_name' => "Career Management in the Digital Age",
               'contact' => 'Andrew Ford',
               'contact_email' => 'andrew.ford@globalknowledge.com',
               'company' => 'Global Knowledge',
              'website' => 'www.globalknowledge.ca' 
              );*/


             break;   
          
           
           default:
             # code...
             break;
         }



          if($email) {
         $f3->set('eventsession', $email);
           \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'Experiences/Checkin/Site/Views/', 'Experiences/Checkin/Site/Views' );
           $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Experiences/Checkin/Site/Views::email/attendee.php' );
           \Dsc\System::instance()->get('mailer')->send($attendee->email, 'Thanks For Attending : ' .$email['session_name'], array($html), 'Info@itechcanada.ca', 'iTech2014 IT Infrastructure and Cloud Conference in Toronto' );    
          }

        //save this checking to the attendee
          $event_checkin = array();

          if(!empty($email['session_name'])) {
              $event_checkin['session_name'] = $email['session_name'];
          }
          
          $event_checkin['time'] = $date->format('Y-m-d H:i:s');
          
          $checkins = @$attendee->checkins;
          if(empty($checkins)) {
              $checkins = array();
          }
          $checkins[] = $event_checkin;
          $attendee->set('checkins',$checkins);
          
          $attendee->save();

        /* $checkins =  $experience->checkins;
         
         $checkins[] = array('id' =>  $attendee->id, 'name'=> $attendee->first_name .' '. $attendee->last_name, 'time' => $date->format('Y-m-d H:i:s'));
         $experience->checkins = $checkins;
         $experience->save(); */
        
         $f3->set('tag',$tag);
         $f3->set('event',$event);
         $f3->set('experience',$experience);
         $f3->set('attendee',$attendee);


       /*  \Dsc\System::instance()->get('theme')->registerViewPath( $f3->get('PATH_ROOT')  . 'Experiences/Checkin/Site/Views/', 'Experiences/Checkin/Site/Views' );
         $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Experiences/Checkin/Site/Views::email/attendee.php' );
         \Dsc\System::instance()->get('mailer')->send($attendee->email, 'Successful Checkin', array($html) );
         $html = \Dsc\System::instance()->get( 'theme' )->renderView( 'Experiences/Checkin/Site/Views::email/eventmanager.php' );
         \Dsc\System::instance()->get('mailer')->send('shae.petersen@gmail.com', 'Successful Checkin', array($html) );
       */  
    
        //trigger External Screen
    /*    if(@$experience->displays)  {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
            $data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'game' => $this->gamePlay());
            $pusher->trigger($experience->{'pusher.channel'}, 'play', $data);
        }

        if(@$experience->userdevice)  {
        // trigger phone 
        $pusher = new \Pusher($f3->get('pusher_key'), $f3->get('pusher_secret'), $f3->get('pusher_app_id'));
        $data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'content' => '/content/car' );
        $pusher->trigger($tag->tagid, 'content', $data);
        } */
  }


}