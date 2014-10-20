<?php 
namespace Dash\Site\Controllers;

class Dashboard extends BaseAuth 
{
    public function index($f3) {


    	$model = new \Dash\Site\Models\Events;
        $state = $model->populateState()->getState();
        $model->setState('list.limit', 50);

        $list = $model->getItems();
        \Base::instance()->set('list', $list );

    	$view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Dash/Site/Views::dashboard/home.php');
    }
}
?>