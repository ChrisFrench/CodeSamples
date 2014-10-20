<?php 
namespace Experiences\Trivia\Admin\Controllers;

class Categories extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\AdminList;
		
    protected $list_route = '/admin/trivia/categories';

    protected function getModel()
    {
        $model = new \Experiences\Trivia\Models\Categories;
        return $model;
    }
    
    public function index()
    {
        $model = $this->getModel();
        $state = $model->emptyState()->populateState()->getState();
        \Base::instance()->set('state', $state );
        \Base::instance()->set( 'paginated', $model->paginate() );
        \Base::instance()->set('selected', 'null' );
        
        $this->app->set('meta.title', 'Categories | Pages');
                
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Experiences/Trivia/Admin/Views::categories/list.php');
    }
    
    public function getDatatable()
    {
        $model = $this->getModel();
        
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        \Base::instance()->set( 'paginated', $model->paginate() );
            
        $view = \Dsc\System::instance()->get('theme');
        $html = $view->renderLayout('Experiences/Trivia/Admin/Views::categories/list_datatable.php');
        
        return $this->outputJson( $this->getJsonResponse( array(
                'result' => $html
        ) ) );
    
    }
    
    public function getAll()
    {
        $model = $this->getModel()->populateState();
        $categories = $model->getList();
        \Base::instance()->set('categories', $categories );

        \Base::instance()->set('selected', 'null' );
        
        $view = \Dsc\System::instance()->get('theme');
        $html = $view->renderLayout('Experiences/Trivia/Admin/Views::categories/list_parents.php');
        
        return $this->outputJson( $this->getJsonResponse( array(
                'result' => $html
        ) ) );
    
    }
    
    public function getCheckboxes()
    {
        $model = $this->getModel()->populateState();
        $categories = $model->getList();
        \Base::instance()->set('categories', $categories );
    
        $selected = array();
        $data = \Base::instance()->get('REQUEST');
        
        $input = $data['category_ids'];
        foreach ($input as $id) 
        {
            $id = $this->inputfilter->clean( $id, 'alnum' );
            $selected[] = array('id' => $id);
        }

        $flash = \Dsc\Flash::instance();
        $flash->store( array( 'metadata'=>array('categories'=>$selected) ) );
        \Base::instance()->set('flash', $flash );
        
        $view = \Dsc\System::instance()->get('theme');
        $html = $view->renderLayout('Experiences/Trivia/Admin/Views::categories/checkboxes.php');
    
        return $this->outputJson( $this->getJsonResponse( array(
                'result' => $html
        ) ) );
    
    }
}
