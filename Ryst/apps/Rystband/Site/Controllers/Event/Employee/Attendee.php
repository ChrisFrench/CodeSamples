<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Attendee extends Auth 
{
    
    public function index($f3)
    {
        $f3->set('pagetitle', 'Attendee');
        $f3->set('subtitle', '');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Site/Views::event/employee/attendee/index.php');
    }

     public function doRegister()
    {   
     $f3 =  \Base::instance();
         
        $tag = $this->validateTag();

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
           \Dsc\System::instance()->get( 'session' )->set( 'tagid', '');
           \Dsc\System::instance()->addMessage( $tag->{'attendee.name'} . ' has been registered' , 'success');
           $f3->reroute('/'.$f3->get('event')->event_id.'/attendee');
           }

           //if created set the auth and than  redirect back to their band url

        }
        catch (\Exception $e) {

        }

    }

   
  
    protected function validateTag() {

        $model = new \Rystband\Site\Models\Tags;
        $model->setState('filter.tagid', \Dsc\System::instance()->get( 'session' )->get( 'tagid'));
        $tag = $model->getItem();
        //TODO do some checks on this tag to make sure we can register/ now we can redirect
        return $tag;

    }


    
}