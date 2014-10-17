<?php
namespace Grams\Models;

class Actions extends \Dsc\Mongo\Collections\Taggable
{
	use \Dsc\Traits\Models\Publishable;
	
    protected $__config = array(
        'default_sort' => array(
            'publication.start.time' => -1
        )
    );
	
    protected $__collection_name = 'grams.actions';
    protected $__type = 'grams.actions';
	
    public function populateState() {
    	parent::populateState();
    	$this->setCondition('metadata.creator.id', \Dsc\System::instance()->auth->getIdentity()->id);
    
    	return $this;
    }
    
    protected function fetchConditions()
    {
        parent::fetchConditions();
        
        $this->publishableFetchConditions();
        
        $this->setCondition('type', $this->__type);
        
        $filter_category_slug = trim($this->getState('filter.category.slug'));
        if (strlen($filter_category_slug))
        {
            if ($filter_category_slug == '--')
            {
                $this->setCondition('categories', array(
                    '$size' => 0
                ));
            }
            else
            {
                $this->setCondition('categories.slug', $filter_category_slug);
            }
        }
        
        $filter_category_id = $this->getState('filter.category.id');
        if (strlen($filter_category_id))
        {
            $this->setCondition('categories.id', new \MongoId((string) $filter_category_id));
        }
        
        $filter_readytorun = $this->getState('filter.readytorun');
        if ($filter_readytorun)
        {
        	$this->setCondition('readytorun', array('$lte' => time()));
        }
        
       
        
        return $this;
    }
	
   
    
    protected function beforeValidate()
    {
       
        return parent::beforeValidate();
    }

    public function validate()
    {
        if (empty($this->hashtags))
        {
            $this->setError('Hashtag is required');
        }
        
       
      
        
        return parent::validate();
    }
    
    protected function beforeSave() {
    	if (empty($this->readytorun))
    	{
    		$this->set('readytorun', $this->nextRun());
    	}
    	
    }
    
    public static function doLike($user_id, $media_id) {
		
    	try {
	    	$instagram = new \Instagram(array(
	    			'apiKey'      => 'XXX',
	    			'apiSecret'   => 'XXX',
	    			'apiCallback' => 'http://gramsmanager.com/grams/connect/auth' // must point to success.php
	    	));
	    	
	    	$user = (new \Users\Models\Users)->setState('filter.id', $user_id)->getItem();
	    	
	    	if(!empty($user->{'instagram.access_token'})) {
	    	$instagram->setAccessToken($user->{'instagram.access_token'});
	    	$like = 	$instagram->likeMedia($media_id);
	    	
		    	if($like) {
		    		throw new \Exception('Successfully Liked');
		    	}
	    	}
			
		} catch ( \Exception $e ) {
			
		} finally {
			
		}
    	
    	
    	
    	
    }
    
    public function run() {
    	
    	$model = new static;
    	$model->setState('filter.published_today', 'true');
    	$model->setState('filter.readytorun', 'true');
    	$list = $model->getList();
    	
    	foreach($list as $action) {
    	switch ($action->{'settings.action'}) {
			  case 'like':
			   $this->processLikeAction($action);
			    break;
			  case 'follow':
			  	$this->processFollowAction($action);
			    break;
			  case 'comment':
			    
			    break;
			 
			  default:
			}
    	}
    	
    }
    
    protected function processLikeAction($action) {
    	$instagram = new \Instagram(array(
    			'apiKey'      => 'XXX',
    			'apiSecret'   => 'XXX',
    			'apiCallback' => 'http://gramsmanager.com/grams/connect/auth' // must point to success.php
    	));
    	
    	
    	$user = (new \Users\Models\Users)->setState('filter.id', $action->{'metadata.creator.id'})->getItem();
    	\Dsc\System::instance()->get('auth')->setIdentity($user);
    	if(!empty($user->{'instagram.access_token'})) {
    		$instagram->setAccessToken($user->{'instagram.access_token'});
    		
    		try {
    			if(empty($action->min_tag_id)) {
    				$feed = $instagram->getTagMedia($action->hashtags,null,20);
    				
    			} else {
    				$feed = $instagram->getTagMedia($action->hashtags,$action->min_tag_id,20);
    			}
    			
    			$i = 0;
    			$count = 0;
    			if(!empty($feed->data)) {
    				
    			
    			foreach($feed->data as $image) {
    				
    				$i = $i + rand(17, 30);
    				if($image->likes->count >= $action->{'settings.like_low'} && $image->likes->count <= $action->{'settings.like_high'} && $image->comments->count >= $action->{'settings.comment_low'} && $image->comments->count <= $action->{'settings.comment_high'} ) {
    					$params =  array(
    							'title' => 'Like This <br> <a target="_blank" href="'. $image->link  .'"><img src="'.$image->images->low_resolution->url.'"></a>',
    							'when' => time() + $i,
    							'priority' => 0,
    							'batch' => null
    					);
    					
    					\Grams\Models\QueueTasks::add('\Grams\Models\Actions::doLike', array($user->id, $image->id), $params);
    					echo 'queued an image'."\n";
    					$count++;
    				} else {
    					echo 'count '. $image->likes->count ."\n";
    					
    					
    				}
    				 	 
    			}
    			//queue next run for alreast one hour away.
    			
    			$action->set('readytorun', $this->nextRun())->set('min_tag_id', $feed->pagination->next_min_id)->store();
    			}
    			} catch (\Exception $e) {
    			echo $e->getMessage();
    		}
    		
    		\Base::instance()->set('count', $count);
    		\Base::instance()->set('action', $action);
    		
    		$html = '<div>';
    		$html .= 'Added '.  $count . ' images to the queue to be liked.';
    		$html .= '</div>';
    		
    		$subject = 'Action: ' .$action->title . ' was just run successfully'; 
    		
    		\Dsc\System::instance()->get('mailer')->send($user->email, $subject, array($html) );
    		
    		return $this;
    		
    		
    		
    		
    		
    	}
    }

    protected  function nextRun() {
    	
    	//set the current time;
    	$time = time();

    	//add a random time for it to run again. 
    	$time = $time + rand('3600', '7200');
    	
    	$date = date_create();
    	
    	date_timestamp_set($date, $time);
    	//if it is between 3 AM and 7 AM, set the time to be at 8 am, and with a random minutes.
    	if (date('H') > 2 && date('H') < 8) {
    		date_time_set(date,8, rand(1,45));
    	}
    	$time =  date_format($date, 'U');
    	//TODO should be check to make sure this is not in the middle of the night?
    	
    	
    	return (int) $time;
    	
    }
    
 
}