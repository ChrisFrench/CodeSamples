<?php 
namespace Rystband\Site\Controllers\Event\Employee;

class Transfer extends BaseAuth 
{   

    
    protected function getModel() 
    {
        $model = new \Rystband\Models\Tags;
        return $model; 
    }
    public function home() {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Transfer Wristband');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::transfer/home.php');
    }
     public function notempty() {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Transfer Wristband');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::transfer/notempty.php');
    }

     public function isempty() {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Transfer Wristband');
        
        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::transfer/empty.php');
    }
    
    public function origin() {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Original Wristband');
        
        $f3->set('id',$f3->get('PARAMS.id'));

        $f3->set('SESSION.transfer', $f3->get('PARAMS.id'));

        $model = $this->getModel();
        $flash = \Dsc\Flash::instance();
        $item = $this->getItem();

        $f3->set('item',$item);
        if (method_exists($item, 'cast')) {
            $item_data = $item->cast();
        } else {
            $item_data = \Joomla\Utilities\ArrayHelper::fromObject($item);
        }

        $flash->store($item_data);
        
        $f3->set('flash', $flash );

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::transfer/origin.php');
    }

    public function destination() {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'New Wristband');
        

       
        $item = $this->getModel()->setState('filter.id', $f3->get('SESSION.transfer'))->getItem();
        $flash = \Dsc\Flash::instance();

        $item->tagid = $f3->get('PARAMS.tagid');
        $item->save();

        $f3->clear('SESSION.transfer');
        
        $f3->set('item',$item);
        if (method_exists($item, 'cast')) {
            $item_data = $item->cast();
        } else {
            $item_data = \Joomla\Utilities\ArrayHelper::fromObject($item);
        }

        $flash->store($item_data);
        
        $f3->set('flash', $flash );

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::transfer/destination.php');
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
        echo $view->render('Rystband/Views::attendee/edit.php');
    }
     public function confirm() 
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
        echo $view->render('Rystband/Views::attendee/confirm.php');
    }

    public function attendee() 
    {
        $f3 = \Base::instance();
        $f3->set('pagetitle', 'Activate Wristband');
        
        $f3->set('tagid',$f3->get('PARAMS.tagid'));

        $model = $this->getModel();
        $flash = \Dsc\Flash::instance();
        $item = $this->getItem();

        $f3->set('item',$item);
        if (method_exists($item, 'cast')) {
            $item_data = $item->cast();
        } else {
            $item_data = \Joomla\Utilities\ArrayHelper::fromObject($item);
        }

        $flash->store($item_data);
        
        $f3->set('flash', $flash );

        $view = \Dsc\System::instance()->get( 'theme' );
        echo $view->render('Rystband/Views::attendee/attendee.php');
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