<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Ticketing extends BaseAuth 
{	

    use \Dsc\Traits\Controllers\CrudItem;

    protected $list_route = '/ticketing';
    protected $create_item_route = '/ticketing/create';
    protected $create_item_confirm_route = '/ticketing/confirm/{id}';
    protected $create_item_customer_route = '/ticketing/customer/{id}';
    protected $get_item_route = '/ticketing/view/{id}';    
    protected $edit_item_route = '/ticketing/edit/{id}';
    
  	protected function getModel() 
    {
        $model = new \Rystband\Models\Tickets;
        return $model; 
    }
    
    protected function getItem() 
    {
        $f3 = \Base::instance();
        $id = $this->inputfilter->clean( $f3->get('PARAMS.id'), 'alnum' );

        $model = $this->getModel()->setState('filter.id', $id);

        try {
            $item = $model->getItem(); 
        } catch ( \Exception $e ) {
            \Dsc\System::instance()->addMessage( "Invalid Item: " . $e->getMessage(), 'error');
            $f3->reroute( $this->list_route );
            return;
        }

        return $item;
    }

    public  function display() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Home');
        
        $selected = array();
        $flash = \Dsc\Flash::instance();

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::ticketing/home.php');
    }
    
    protected function displayCreate() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Activate Wristband');
        
        $f3->set('tagid',$f3->get('PARAMS.tagid'));
        $selected = array();
        $flash = \Dsc\Flash::instance();

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::ticketing/register.php');
    }

    protected function doAdd($data) 
    {    
        if (!isset($data['submitType'])) {
            $data['submitType'] = "save_confirm";
        }
        
        $f3 = \Base::instance();
        $flash = \Dsc\Flash::instance();
        $model = $this->getModel();
        
        // save
        try {
            $values = $data;
            unset($values['submitType']);
            //\Dsc\System::instance()->addMessage(\Dsc\Debug::dump($values), 'warning');
            $this->item = $model->create($values);


            if($this->item->tagid) {
                $tags = new \Rystband\Models\Tags();
                $tag = $tags->setState('filter.id',$this->item->tagid)->getItem();
                $tag->set('attendee.id',$this->item->_id);
                $tag->set('attendee.name',$this->item->first_name . ' ' .$this->item->last_name);
                $tag->save();
            }


        }
        catch (\Exception $e) {
            \Dsc\System::instance()->addMessage('Save failed with the following errors:', 'error');
            foreach ($model->getErrors() as $error)
            {
                \Dsc\System::instance()->addMessage($error, 'error');
            }
            
            if ($f3->get('AJAX')) {
                // output system messages in response object
                return $this->outputJson( $this->getJsonResponse( array(
                        'error' => true,
                        'message' => \Dsc\System::instance()->renderMessages()
                ) ) );
            }
            
            // redirect back to the create form with the fields pre-populated
            \Dsc\System::instance()->setUserState('use_flash.' . $this->create_item_route, true);
            $flash->store($data);
            
            $this->setRedirect( $this->create_item_route );
                        
            return false;
        }
                
        // redirect to the editing form for the new item
        \Dsc\System::instance()->addMessage('Item saved');
        
        if (method_exists($this->item, 'cast')) {
            $this->item_data = $this->item->cast();
        } else {
            $this->item_data = \Joomla\Utilities\ArrayHelper::fromObject($this->item);
        }
        
        if ($f3->get('AJAX')) {
            return $this->outputJson( $this->getJsonResponse( array(
                    'message' => \Dsc\System::instance()->renderMessages(),
                    'result' => $this->item_data
            ) ) );
        }
        
        switch ($data['submitType']) 
        {
            case "save_new":
                $route = $this->create_item_route;
                break;
             case "save_customer":
                $flash->store($this->item_data);
                $id = $this->item->get( $this->getItemKey() );
                $route = str_replace('{id}', $id, $this->create_item_customer_route );   
                break;      
             case "save_confirm":
                 $flash->store($this->item_data);
                $id = $this->item->get( $this->getItemKey() );
                $route = str_replace('{id}', $id, $this->create_item_confirm_route );   
                break;    
            case "save_close":
                $route = $this->list_route;
                break;
            default:
                $flash->store($this->item_data);
                $id = $this->item->get( $this->getItemKey() );
                $route = str_replace('{id}', $id, $this->edit_item_route );                
                break;
        }

        $this->setRedirect( $route );
        
        return $this;
    }

    protected function doUpdate(array $data, $key=null) 
    {
        
        if (!isset($data['submitType'])) {
            $data['submitType'] = "save_confirm";
        }
        
        $f3 = \Base::instance();
        $flash = \Dsc\Flash::instance();
        $model = $this->getModel();
        $this->item = $this->getItem();
        
        // save
        $save_as = false;
        try {
            $values = $data; 
            unset($values['submitType']);
            
                $this->item = $model->update($this->item, $values);
                
                if($this->item->tagid) {
                $tags = new \Rystband\Models\Tags();
                $tag = $tags->setState('filter.id',$this->item->tagid)->getItem();
                $tag->set('attendee.id',$this->item->_id);
                $tag->set('attendee.name',$this->item->first_name . ' ' .$this->item->last_name);
                $tag->save();
                
            }      
            

        }
        catch (\Exception $e) {
            \Dsc\System::instance()->addMessage('Save failed with the following errors:', 'error');
            \Dsc\System::instance()->addMessage($e->getMessage(), 'error');
            foreach ($model->getErrors() as $error)
            {
                \Dsc\System::instance()->addMessage($error, 'error');
            }
            
            if ($f3->get('AJAX')) {
                // output system messages in response object
                return $this->outputJson( $this->getJsonResponse( array(
                        'error' => true,
                        'message' => \Dsc\System::instance()->renderMessages()
                ) ) );
            }
        
            // redirect back to the create form with the fields pre-populated
            $flash->store($data);
            $id = $this->item->get( $this->getItemKey() );
            $route = str_replace('{id}', $id, $this->edit_item_route );
            
            $this->setRedirect( $route );
            
            return false;           
        }
        
        // redirect to the editing form for the new item
        if (method_exists($this->item, 'cast')) {
            $this->item_data = $this->item->cast();
        } else {
            $this->item_data = \Joomla\Utilities\ArrayHelper::fromObject($this->item);
        }
        
        if ($f3->get('AJAX')) {
            return $this->outputJson( $this->getJsonResponse( array(
                    'message' => \Dsc\System::instance()->renderMessages(),
                    'result' => $this->item_data
            ) ) );
        }
        
        switch ($data['submitType']) 
        {
            case "save_new":
                $route = $this->create_item_route;
                break;
             case "save_customer":
                $flash->store($this->item_data);
                $id = $this->item->get( $this->getItemKey() );
                $route = str_replace('{id}', $id, $this->create_item_customer_route );   
                break;      
             case "save_confirm":
                 $flash->store($this->item_data);
                $id = $this->item->get( $this->getItemKey() );
                $route = str_replace('{id}', $id, $this->create_item_confirm_route );   
                break;    
            case "save_close":
                $route = $this->list_route;
                break;
            default:
                $flash->store($this->item_data);
                $id = $this->item->get( $this->getItemKey() );
                $route = str_replace('{id}', $id, $this->edit_item_route );                
                break;
        }

        $this->setRedirect( $route );
        
        return $this;        
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Wristband');

     
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::ticketing/edit.php');
    }

    public function confirm() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Ticket');
        
        $model = $this->getModel();
   
        $item = $this->getItem();
        $f3->set('item',$item);

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::ticketing/confirm.php');
    }

    public function attendee() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Activate Wristband');
        
        $f3->set('tagid',$f3->get('PARAMS.tagid'));

        $model = $this->getModel();
   
        $item = $this->getItem();
        $f3->set('item',$item);
        
        $selected = array();
        $flash = \Dsc\Flash::instance();

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::ticketing/attendee.php');
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