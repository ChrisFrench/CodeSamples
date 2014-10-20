<?php 
namespace Dash\Admin\Controllers;

class Customer extends \Admin\Controllers\BaseAuth 
{
	use \Dsc\Traits\Controllers\CrudItemCollection;
	
	protected $list_route = '/admin/customers';
	protected $create_item_route = '/admin/customer/create';
	protected $get_item_route = '/admin/customer/read/{id}';
	protected $edit_item_route = '/admin/customer/edit/{id}';
	
	protected function getModel()
	{
		$model = new \Dash\Models\Customers;
		return $model;
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
		$f3->set('pagetitle', 'Create Customer');


		$view = \Dsc\System::instance()->get('theme');
		$view->event = $view->trigger( 'onDisplayAdminCustomerEdit', array( 'item' => $this->getItem(), 'tabs' => array(), 'content' => array() ) );
		
		echo $view->render('Dash/Admin/Views::customers/create.php');
	}
	
	protected function displayEdit()
	{
		$f3 = \Base::instance();
		$f3->set('pagetitle', 'Edit Customer');
		
		

		$view = \Dsc\System::instance()->get('theme');
		$view->event = $view->trigger( 'onDisplayAdminCustomerEdit', array( 'item' => $this->getItem(), 'tabs' => array(), 'content' => array() ) );
				
		echo $view->render('Dash/Admin/Views::customers/edit.php');
	}
	
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
	
	protected function displayRead() {}
}