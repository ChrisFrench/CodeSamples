<?php 
namespace Proposals\Admin\Controllers;

class Proposals extends \Admin\Controllers\BaseAuth 
{
	use \Dsc\Traits\Controllers\AdminList;
	
	protected $list_route = '/admin/proposals';
	
	protected function getModel($name='Proposals')
	{
	    $model = new \Proposals\Admin\Models\Proposals;
		
		return $model;
	}

    public function index()
    {
        $this->checkAccess( __CLASS__, __FUNCTION__ );
        
        $model = $this->getModel();
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
    
        $paginated = $model->paginate();
        \Base::instance()->set('paginated', $paginated );
         
        $view = \Dsc\System::instance()->get('theme');
        echo $view->render('Proposals/Admin/Views::proposals/list.php');
    }
}