<?php 
namespace Dash\Site\Controllers\Event;

class Wristbands extends \Dash\Site\Controllers\BaseAuth 
{
    public function index() {
        \Base::instance()->set('pagetitle', 'Wristbands');
        \Base::instance()->set('subtitle', '');
        
        $model = new \Dash\Site\Models\Event\Tags;
  
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        $list = $model->paginate();
       
        \Base::instance()->set('list', $list);
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/wristbands/list.php');
    }

     public function generate() {
        \Base::instance()->set('pagetitle', 'Wristbands');
        \Base::instance()->set('subtitle', '');
        
        $model = new \Dash\Site\Models\Event\Tags;
  
        $state = $model->populateState()->getState();
        \Base::instance()->set('state', $state );
        
        $list = $model->paginate();
      
        \Base::instance()->set('list', $list );
        
        $view = \Dsc\System::instance()->get( 'theme' );
        $view->setVariant('event.php');
        echo $view->render('Dash/Site/Views::event/wristbands/generate.php');
    }

    public function doGenerating() {  
        for ($i=0; $i < \Base::instance()->get('POST.amount', '0'); $i++) { 
           $model = (new \Dash\Site\Models\Event\Tags)->save(); 
        }
        \Base::instance()->reroute('/'.\Base::instance()->get('PARAMS.eventid').'/wristbands');          
    }

    public function doCSV() {  
      
        $list = (new \Dash\Site\Models\Event\Tags)->populateState()->setCondition('attendee.id', array('$exists' => false))->setCondition('ticket.id', array('$exists' => false))->setCondition('sysgentag',1)->getItems(); 

        $fp = fopen('php://output', 'w');
        
        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="emptytags.csv"');

         $fp = fopen('php://output', 'w');
        foreach ($list as $tag) {
           $array[0] = 'http://ryst.cc/b/'.$tag->tagid;
           fputcsv($fp, $array);
        }

        fclose($fp);
        die();
    }
    
    
}


?>