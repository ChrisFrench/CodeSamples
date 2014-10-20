<?php 
namespace Experiences\Barcodeid\Site\Controllers;

class Controller extends \Experiences\Base\Site\Controllers\Base 
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

        if(!$attendee) {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
            $data = array('tag' => (array) $tag->cast());
            $pusher->trigger($experience->{'pusher.channel'}, 'noAttendee', $data);
        }


        //trigger External Screen
        if(@$experience->displays)  {
            $pusher = new \Pusher($experience->{'pusher.public'}, $experience->{'pusher.private'}, $experience->{'pusher.app_id'});
    			  $data = array('tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'game' => $this->gamePlay());
    			  $pusher->trigger($experience->{'pusher.channel'}, 'play', $data);
        }

        if(@$experience->userdevice)  {
        // trigger phone 
        $pusher = new \Pusher($f3->get('pusher_key'), $f3->get('pusher_secret'), $f3->get('pusher_app_id'));
        $data = array('device' => (array) $device->cast(), 'tag' => (array) $tag->cast(), 'attendee' => (array) $attendee->cast(), 'content' => '/content/car' );
        $pusher->trigger($tag->tagid, 'content', $data);
        }
	}

	function register() {
		
		$f3 = \Base::instance();
		$tagid = $f3->get('POST.tagid');

		$tags = new \ Dash\Site\Models\Event\Tags;
        $tags->setState('filter.tagid', $tagid);
        $tag = $tags->getItem();
        
        if($tag->{'attendee.id'}) {
        	$attendees = new \ Dash\Site\Models\Event\Attendees;
        	$attendees->setState('filter.id', $tag->{'attendee.id'});
        	$attendee = $attendees->getItem();
        	$f3->set('attendee', $attendee);

        	$view = \Dsc\System::instance()->get( 'theme' );
        	echo $view->render('Experiences/Barcodeid/Site/Views::display/alreadyassigned.php');
        	die();
        }

		$data = $this->apiCall();

		if($data) {
		 //OK we got data lets create a new attendee
		$attendees = new \Dash\Site\Models\Event\Attendees;
		$attendees->setEvent($tag->{'event.id'});
		$attendees->tagid = $tag->id;
		$attendees->barcode = $f3->get('POST.barcode'); 
		$attendees->first_name =(string) $data->First_Name;
		$attendees->last_name =(string) $data->Last_Name;
		$attendees->email =(string) $data->Email;
		$attendees->itech_cross = (array) $data;
		$attendee = $attendees->save();

		//update tag
		$tag->set('attendee.id',$attendee->id);
		$tag->set('attendee.name',$attendee->first_name .' '.$attendee->last_name);
		$tag->save();

		$f3->set('attendee', $attendee);
       	
		} else {
			$attendees = new \Dash\Site\Models\Event\Attendees;
			$attendees->setEvent($tag->{'event.id'});
			$attendees->tagid = $tag->id;
			$attendees->barcode = $f3->get('POST.barcode'); 	
			$attendee = $attendees->save();
			//update tag
		$tag->set('attendee.id',$attendee->id);
		$tag->set('attendee.name',$attendee->first_name .' '.$attendee->last_name);
		$tag->save();
		}
		
		$f3->reroute('/b/'.$f3->get('POST.tagid'));
	


	}



	function apiCall() {
	$f3 = \Base::instance();
	//Caspio Bridge WS API WSDL file
	$wsdl = "http://bridge.caspio.net/ws/API.asmx?wsdl";
	$client = new \SoapClient($wsdl);
	

	$number = $f3->get('POST.barcode'); 
	
	$criteria = "";
	$criteria .= "CONVERT(nvarchar(100), badge_number) LIKE $number";

	$arr = array();
	$arr["AccountID"] = 'dbccanada';
	$arr["Profile"] = 'crosscliq';
	$arr["Password"] = 'dsz62KgzrrnuwoGn';
	$arr["ObjectName"] = 'contact_reg_details_itech_cross';
	$arr["IsView"] = true;
	$arr["FieldList"] = '*';
	$arr["Criteria"] = $criteria;
	$arr["OrderBy"] = "";
	$arr["FieldDelimiter"] = "";
	$arr["StringDelimiter"] = "";
	

	$IsSchema = 1;
	$IsRaw= 0;
	$IsElements= 0;
	$IsBase64= 0;
	//submit the request to WS API
	//$resRecords = $client->SelectDataRaw($arr["AccountID"], $arr["Profile"], $arr["Password"], $arr["ObjectName"], $arr["IsView"], $arr["FieldList"], $arr["Criteria"], $arr["OrderBy"], $arr["FieldDelimiter"], $arr["StringDelimiter"]);
	$resRecords = $client->SelectDataXML($arr["AccountID"], $arr["Profile"], $arr["Password"], $arr["ObjectName"], $arr["IsView"], $arr["FieldList"], $arr["Criteria"], $arr["OrderBy"], $arr["FieldDelimiter"], $arr["StringDelimiter"], $IsSchema,  $IsRaw,  $IsElements,  $IsBase64);
	 
	//$resRecords=  str_replace('<_V_contact_reg_details_itech_cross>', '', $resRecords);
	//$resRecords=  str_replace('<!--_V_contact_reg_details_itech_cross-->', '', $resRecords);
	$obj = simplexml_load_string($resRecords);
	return $obj->_V_contact_reg_details_itech_cross;
	}


}