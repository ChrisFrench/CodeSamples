<?php 
namespace Dash\Site\Controllers\Event;

class Attendees extends \Dash\Site\Controllers\BaseAuth 
{   
   
    
    public function index() {
        \Base::instance()->set('pagetitle', 'Attendees');
        \Base::instance()->set('subtitle', '');
        
        $model = new \Dash\Site\Models\Event\Attendees;
        $model->setState('filter.profile.complete', 1);
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        $list = $model->paginate();
     
        
        \Base::instance()->set('list', $list );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/attendees/list.php');
    }


    public function toCSV () {
        $model = new \Dash\Site\Models\Event\Attendees;
        $list = $model->getList();
       
        $f3 = \Base::instance();
        $file = new \SplFileObject($f3->get('PATH_ROOT').'logs/output.csv', 'w');
        $writer = new \Ddeboer\DataImport\Writer\CsvWriter($file, 'w', ',');

        $writer->writeItem(array('first_name', 'last_name', 'email', 'phone', 'zipcode', 'age', 'gender', 'created', 'SMS OPT IN' , 'EMAIL OPT IN'));
        foreach($list as $attendee) {
            $array = array();
            $array[] = $attendee->first_name;
            $array[] = $attendee->last_name;
            $array[] = $attendee->email;
            $array[] = $attendee->phone;
            $array[] = $attendee->zipcode;
            $array[] = $attendee->age;
            $array[] = $attendee->gender;
            $array[] = $attendee->{'create.local'};
            if(@$attendee->{'offers.sms'} == 'on') {
            $array[] = 'YES'; 
            }else {
             $array[] = 'NO'; 
            }
            if(@$attendee->{'offers.email'} == 'on') {
            $array[] = 'YES'; 
            }else {
             $array[] = 'NO'; 
            }

        $writer->writeItem($array) ;
        }
        $writer->finish();


    }




}


?>