<?php 
namespace Dash\Site\Controllers\Event;

class Attendee extends \Dash\Site\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItemCollection;

    protected $list_route = '/';
    protected $create_item_route = '/attendee/create';
    protected $get_item_route = '/attendee/view/{id}';    
    protected $edit_item_route = '/attendee/edit/{id}';
    
    protected function getModel() 
    {
        $model = new \Dash\Site\Models\Event\Attendees;
        return $model; 
    }
    public function __construct() {
        $f3 = \Base::instance();
        $this->list_route = '/'. $f3->get('PARAMS.eventid').'/attendees/';
        $this->create_item_route = '/'. $f3->get('PARAMS.eventid').'/attendee/create';
        $this->get_item_route = '/'. $f3->get('PARAMS.eventid').'/attendee/view/{id}';
        $this->edit_item_route = '/'. $f3->get('PARAMS.eventid').'/attendee/edit/{id}';

        parent::__construct();
    }
    
    protected function getItem() 
    {
        $f3 = \Base::instance();
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );
        $model = $this->getModel()
            ->setState('filter.id', $id);

        try {
            $item = $model->getItem();
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
            $f3->reroute( $this->list_route );
            return;
        }

        return $item;
    }
    
    protected function displayCreate() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Create Attendees');
        
        $selected = array();
        $flash = \Dsc\Flash::instance();
       
        
        $flash->store( $flash->get('old') );        

        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::event/attendees/create.php');
    }
    
     protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Attendees');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::event/attendees/edit.php');
    }

    //reroute this to  the \Dash\Site\
    /**
     * This controller doesn't allow reading, only editing, so redirect to the edit method
     */
    protected function doRead(array $data, $key=null) 
    {
        $f3 = \Base::instance();
        $id = $this->getItem()->get( $this->getItemKey() );
        $route = str_replace('{id}', $id, $this->edit_item_route );
        $f3->reroute( $route );
    }

    
    protected function displayRead() {

        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Attendees');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::event/attendees/edit.php');
    }
}