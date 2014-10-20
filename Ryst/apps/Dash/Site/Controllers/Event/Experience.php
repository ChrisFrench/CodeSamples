<?php 
namespace Dash\Site\Controllers\Event;

class Experience extends \Dash\Site\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItemCollection;

    protected $list_route = '/';
    protected $create_item_route = '/experience/create';
    protected $get_item_route = '/experience/view/{id}';    
    protected $edit_item_route = '/experience/edit/{id}';
    
    protected function getModel() 
    {
        $model = new \Dash\Site\Models\Event\Experiences;
        return $model; 
    }
    public function __construct() {
        
        $f3 = \Base::instance();
        $this->list_route = '/'. $f3->get('PARAMS.eventid').'/experiences/';
        $this->create_item_route = '/'. $f3->get('PARAMS.eventid').'/experience/create';
        $this->get_item_route = '/'. $f3->get('PARAMS.eventid').'/experience/view/{id}';
        $this->edit_item_route = '/'. $f3->get('PARAMS.eventid').'/experience/edit/{id}';

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
        $f3->set('pagetitle', 'Create Experience');
        
        $selected = array();
        $flash = \Dsc\Flash::instance();
        
        $model = new \Dash\Models\Experiences;

        $list = $model->paginate();
        
        $f3->set('list', $list);

        $flash->store( $flash->get('old') );        

        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::event/experiences/create.php');
    }
    
     protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit Experience');
        
        //CHECK to see if this experience is being editted has a custom editing view
        $item = $f3->get('item');
         
        $file = $f3->get('PATH_ROOT') . 'apps/Experiences/'.ucfirst($item->type).'/Dash/Views/edit/edit.php';
        $view = \Dsc\System::instance()->get( 'theme' );
        
        if (file_exists( $file )) {
             echo $view->render('Experiences/'.ucfirst($item->type).'/Dash/Views::edit/edit.php'); 
        } else {
             echo $view->render('Dash/Site/Views::event/experiences/edit.php'); 
        }

      
      
    }


    
    protected function displayRead() {

        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Edit experiences');
        //CHECK to see if this experience is being editted has a custom editing view
        $item = $f3->get('item');
         
        $file = $f3->get('PATH_ROOT') . 'apps/Experiences/'.$item->type.'/Dash/Views/view/view.php';
        $view = \Dsc\System::instance()->get( 'theme' );
        if (file_exists( $file )) {
            echo $view->render('Experiences/'.$item->type.'/Dash/Views::view/view.php'); 
        } else {
             echo $view->render('Dash/Site/Views::event/experiences/view.php'); 
        }
    }
}