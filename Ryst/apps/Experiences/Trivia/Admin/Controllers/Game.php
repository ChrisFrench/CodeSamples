<?php 
namespace Experiences\Trivia\Admin\Controllers;

class Game extends \Admin\Controllers\BaseAuth 
{
    use \Dsc\Traits\Controllers\CrudItemCollection;
    use \Dsc\Traits\Controllers\SupportPreview;

    protected $list_route = '/admin/trivia/games';
    protected $create_item_route = '/admin/trivia/game/create';
    protected $get_item_route = '/admin/trivia/game/read/{id}';    
    protected $edit_item_route = '/admin/trivia/game/edit/{id}';
    
    
    public function launchGameNow() {
    	//SET THE PUBLICATION STATUS TO RIGHT NOW MAKING IT LIVE
    	$item = $this->getItem();
    	
    	$item->publish();
    	
    	$pusher_settings = \Pusher\Models\Settings::fetch();
    	$pusher = new \Pusher\Pusher( $pusher_settings->get('pusher.key'), $pusher_settings->get('pusher.secret'), $pusher_settings->get('pusher.app_id'));
    	$pusher->trigger( 'user-actions', 'game-start', array() );
    	\Dsc\System::instance()->addMessage( 'Game '.$item->title.' has been launched.' );
    	$this->app->reroute( '/admin/trivia/games' );
    	//do a pusher action to push everyone to  the game
    }
    
    public function deleteUserData(){
    	$game_id = $this->inputfilter->clean( $this->app->get('PARAMS.id'), 'alnum' );
    	$user_id = (string)$this->inputfilter->clean( $this->app->get('PARAMS.userid'), 'alnum' );
    	
    	if( !strlen( $user_id ) ){ // no user ID
			$this->app->reroute( '/admin/trivia/game/edit/'.$game_id );    	 
    		return;
    	}
    	$key = 'game.trivia.'.(string)$game_id;
    	
    	\Mgx\Models\Attendees::collection()->update( array( '_id' => new \MongoId( $user_id ) ), 
    												array( '$unset' => array( $key => '' ) ), array('upsert'=>true, 'multiple'=>false) );
    	 
    	\Dsc\System::instance()->addMessage( 'User data were deleted' );
    	$this->app->reroute( '/admin/trivia/game/edit/'.$game_id );    	 
    }
    
    public function gameOff() {
    	//SET THE PUBLICATION STATUS TO RIGHT NOW MAKING IT LIVE
    	$item = $this->getItem();
    	
    	$item->unpublish();    	 
    	$pusher_settings = \Pusher\Models\Settings::fetch();
    	$pusher = new \Pusher\Pusher( $pusher_settings->get('pusher.key'), $pusher_settings->get('pusher.secret'), $pusher_settings->get('pusher.app_id'));
    	$pusher->trigger( 'user-actions', 'game-stop', array() );
    	\Dsc\System::instance()->addMessage( 'Game '.$item->title.' has been stopped.' );
    	$this->app->reroute( '/admin/trivia/games' );
    	//do a pusher action to push everyone to  the game
    }
  
    protected function getModel($name = 'games')
    {
    	$model = null;
    	switch( $name ) {
    		case 'games' :
    			$model = new \Experiences\Trivia\Models\Games;
    			break;
    		case 'categories' :
    			$model = new \Experiences\Trivia\Models\Categories;
    			break;
    		case "group":
    		case "groups":
    			$model = new \Users\Models\Groups;
    			break;
    	}
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
        
        $item = $this->getItem();
        
        $model = new \Experiences\Trivia\Models\Categories;
        $categories = $model->getList();
        \Base::instance()->set('categories', $categories );
        \Base::instance()->set('selected', 'null' );
        $groups = $this->getModel('groups')->getItems();
        
        $this->app->set('groups', $groups );
        
        $selected = array();
        $flash = \Dsc\Flash::instance();
        $input = $flash->old('category_ids');

        if (!empty($input)) 
        {
            foreach ($input as $id)
            {
                $id = $this->inputfilter->clean( $id, 'alnum' );
                $selected[] = array('id' => $id);
            }
        }
        
        $flash->store( (array) $flash->get('old') + array('categories'=>$selected));        

        $all_tags = $this->getModel()->getTags();
        \Base::instance()->set('all_tags', $all_tags );
        
        $this->app->set('meta.title', 'Create Game');
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayTriviaGameEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        
        echo $view->render('Experiences/Trivia/Admin/Views::games/create.php');
    }
    
    protected function displayEdit()
    {
        $f3 = \Base::instance();

        $item = $this->getItem();
        $groups = $this->getModel('groups')->getItems();
        
        $this->app->set('groups', $groups );
        
        $model = new \Experiences\Trivia\Models\Categories;
        $categories = $model->getList();
        \Base::instance()->set('categories', $categories );
        \Base::instance()->set('selected', 'null' );
        
        $all_tags = $this->getModel()->getTags();
        \Base::instance()->set('all_tags', $all_tags );
        
        $this->app->set('meta.title', 'Edit Game');
        $this->app->set( 'allow_preview', $this->canPreview( true ) );
        
        $view = \Dsc\System::instance()->get('theme');
        $view->event = $view->trigger( 'onDisplayTriviaGameEdit', array( 'item' => $item, 'tabs' => array(), 'content' => array() ) );
        
        echo $view->render('Experiences/Trivia/Admin/Views::games/edit.php');
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