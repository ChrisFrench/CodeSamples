<?php 
namespace Dash\Site\Controllers\Event;

class Activity extends \Dash\Site\Controllers\BaseAuth 
{
    
    public function display() {
        \Base::instance()->set('pagetitle', 'Attendees');
        \Base::instance()->set('subtitle', '');
        
        $model = new \Dash\Site\Models\Event\Attendees;
        $model->setState('filter.profile.complete', 1);
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        $list = $model->paginate();
     
        \Base::instance()->set('list', $list );
        
        $pagination = new \Dsc\Pagination($list['total'], $list['limit']);       
        \Base::instance()->set('pagination', $pagination );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/attendees/list.php');
    }


    public function movetoattendee() {

    	$array = array();
    	$array[] = 'Word of Mouth';
    	$array[] = 'Radio';
    	$array[] = 'Mall Signage';
    	$array[] = 'Social Media';
    	$array[] = 'Friend/Family';
    	$array[] = 'Community Event';
    	$array[] = 'Newspaper';
    	$array[] = 'News';
    	$array[] = 'Other';


    	foreach ($array as $key => $value) {
    		# code...
    	}
    	$model = new \Dash\Site\Models\Event\Attendees;
        $model->setFilter('howdidyouhear', $value);
      
        $count = $model->getTotal();

      	echo $value .' : '.$count;

    }

}


?>