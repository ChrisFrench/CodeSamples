<?php 
namespace Dash\Site\Controllers\Event;

class Social extends \Dash\Site\Controllers\BaseAuth 
{
     use \Dsc\Traits\Controllers\CrudItem;

    protected $list_route = '/';
    protected $create_item_route = '/social/create';
    protected $get_item_route = '/social/view/{id}';    
    protected $edit_item_route = '/social/edit/{id}';


    public function index()
    {
      //  $this->checkAccess( __CLASS__, __FUNCTION__ );
        
        $model = new \Dash\Site\Models\Event\Social;
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated );
        
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/social/list.php');
        //$view = \Dsc\System::instance()->get('theme');
        //echo $view->render('Users/Admin/Views::users/list.php');
    }

      protected function getModel() 
    {
        $model = new \Dash\Site\Models\Event\Social;
        return $model; 
    }
    
    public function __construct() {
        $f3 = \Base::instance();
        $this->list_route = '/'. $f3->get('PARAMS.eventid').'/social/';
        $this->create_item_route = '/'. $f3->get('PARAMS.eventid').'/social/create';
        $this->get_item_route = '/'. $f3->get('PARAMS.eventid').'/social/view/{id}';
        $this->edit_item_route = '/'. $f3->get('PARAMS.eventid').'/social/edit/{id}';

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
        $f3->set('pagetitle', 'Create Devices');
        
        $selected = array();
        $flash = \Dsc\Flash::instance();
       
        
        $flash->store( $flash->get('old') );        

        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::event/social/create.php');
    }
    
     protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Devices');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::event/social/edit.php');
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
        $f3->set('pagetitle', 'Edit Devices');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::event/social/edit.php');
    }

}


?>