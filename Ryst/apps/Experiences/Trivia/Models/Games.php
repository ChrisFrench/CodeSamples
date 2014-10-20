<?php 
namespace Experiences\Trivia\Models;

class Games extends \Dsc\Mongo\Collections\Content
{
	public $publication = array(
			'status' => 'unpublished',
			'start_date' => null,
			'start_time' => null,
			'end_date' => null,
			'end_time' => null,
			'start' => null,
			'end' => null
	);
	
	protected $__default_config = array(
			'cache_enabled' => true,
			'cache_lifetime' => 0,
			'track_states' => true,
			'context' => null,
			'default_sort' => array(
					'_id' => 1
			),
			'crud_item_key' => '_id',
			'append' => true,
			'ignored' => array()
	);

	public $categories = array();
	public $groups = array();
	
	public $featured_image = array();
	
	protected $__config = array(
			'default_sort' => array(
					'publication.start.time' => -1
			)
	);
	
	protected $__collection_name = 'trivia.games';
	protected $__type = 'trivia.games';
	
	protected function fetchConditions()
	{
		parent::fetchConditions();
	
		$filter_groups = (array) $this->getState('filter.groups');
		if (!empty($filter_groups))
		{
			$filter_groups = array_filter( array_values( $filter_groups ), function( $var ) {return !empty( trim($var) ); } );
		
			if (!empty($filter_groups)) {
				if( count( $filter_groups ) == 1 && $filter_groups[0] == '--' ) {
					$this->setCondition('group', array( '$size' => 0 ) );
				} else {
					$this->setCondition('group', array( '$in' => $filter_groups ) );
				}
				 
			}
		}
		
		$filter_groups_in = $this->getState('filter.groups_in');
		if (count($filter_groups_in))
		{
			$groups = array();
			foreach($filter_groups_in as $g) {
				$groups[] =  new \MongoId((string) $g);
				//$groups[] = $g;
			}
			$this->setCondition('groups.id', array( '$in' => $groups ) );
		}
	
		return $this;
	}
	
	
	protected function beforeValidate()
	{
		if (!empty($this->category_ids))
		{
			$category_ids = $this->category_ids;
			unset($this->category_ids);
	
			$categories = array();
			if ($list = (new \Experiences\Trivia\Models\Categories())->setState('select.fields', array(
					'title',
					'slug'
			))
			->setState('filter.ids', $category_ids)
			->getList())
			{
				foreach ($list as $list_item)
				{
					$cat = array(
							'id' => $list_item->id,
							'title' => $list_item->title,
							'slug' => $list_item->slug
					);
					$categories[] = $cat;
				}
			}
			$this->categories = $categories;
		}
	
		if (!empty($this->images))
		{
			$images = array();
			$current = $this->images;
			$this->images = array();
	
			foreach ($current as $image)
			{
				if (!empty($image['image']))
				{
					$images[] = array(
							'image' => $image['image']
					);
				}
			}
	
			$this->images = $images;
		}
	
		unset($this->parent);
		unset($this->new_category_title);
	
		return parent::beforeValidate();
	}
	
	protected function beforeSave()
	{
	
		if (!empty($this->__groups))
		{
			if (is_string($this->__groups)) {
				$this->__groups = \Base::instance()->split( $this->__groups );
			}
	
			$groups = array();
			foreach ($this->__groups as $key => $id)
			{
				$item = (new \Users\Models\Groups())->setState('filter.id', $id)->getItem();
				$groups[] = array(
						"id" => $item->id,
						"title" => $item->title,
						"slug" => $item->slug
				);
			}
			$this->groups = $groups;
		}
	
		// ensure that groups are unique
		if (!empty($this->groups))
		{
			$groups = array();
			foreach ($this->groups as $key => $id)
			{
				if (is_array($id))
				{
					if (!empty($id['id']))
					{
						$group_id = $id['id'];
						if (!array_key_exists((string) $group_id, $groups))
						{
							$groups[(string) $group_id] = $id;
						}
					}
				}
				elseif (is_string($id))
				{
					if (!array_key_exists((string) $id, $groups))
					{
						$item = (new \Users\Models\Groups())->setState('filter.id', $id)->getItem();
						if (!empty($item->id))
						{
							$groups[(string) $item->id] = array(
									"id" => $item->id,
									"title" => $item->title,
									"slug" => $item->slug
							);
						}
					}
				}
			}
	
			$this->groups = array_values($groups);
		}

		return parent::beforeSave();
	}
	
	public function getUsers(){
		return (new \Mgx\Models\Attendees)->setState( 'filter.game_id', (string)$this->id )->getList();
	}

	/**
	 * Get each group's cumulattive score for this game 
	 */
	public function groupScores()
	{
	    $groups = array(
	        'northeast',
            'central',
            'southeast',
            'ohio-valley',
            'southwest',
            'team-1',
            'team-2',
            'canada',
            'northwest',
            'team-3'
	    );
	    $scores = array();
	    $averages = array();
	    
	    foreach ($groups as $group) 
	    {
	        if (!isset($scores[$group])) 
	        {
	            $scores[$group] = 0;
	        }
	        
	        if (!isset($averages[$group]))
	        {
	            $averages[$group] = array(
	                'group' => ucwords( str_replace('-', ' ', $group) ),
	                'count' => 0,
	                'average' => 0,
	                'total' => 0	                 
	            );
	        }	        
	        
	        // get all the users in this group
	        $users = \Users\Models\Users::collection()->find(array(
	            'triviagroup' => $group
	        ));
	        
	        if (!empty($users)) 
	        {
	            // for each user, get their score for this game, and add it to the running total	            
	            foreach ($users as $doc) 
	            {
	                if (!empty($doc['game']['trivia'][(string)$this->id]['score'])) 
	                {
	                    $scores[$group] = $scores[$group] + $doc['game']['trivia'][(string)$this->id]['score'];
	                }
	            }
	            
	            $count = count($users);
	            $averages[$group]['count'] = $count;
	            $averages[$group]['total'] = $scores[$group];
	            if (!empty($scores[$group])) 
	            {
	                $averages[$group]['average'] = number_format( $scores[$group] / $count, 2 );
	            }	            
	        }
	    }
	    
	    $results = \Dsc\ArrayHelper::sortArrays($averages, 'average', -1);
	    
	    return $results;
	}

}