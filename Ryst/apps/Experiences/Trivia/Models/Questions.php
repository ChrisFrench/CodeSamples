<?php 
namespace Experiences\Trivia\Models;

class Questions extends \Dsc\Mongo\Collections\Taggable
{
	
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
	
	public $question_image = array();
	
	public $anwsers = array();
	
	protected $__config = array(
			'default_sort' => array(
					'publication.start.time' => -1
			)
	);
	
	protected $__collection_name = 'trivia.questions';
	protected $__type = 'trivia.questions';
	
	protected function fetchConditions()
	{
		parent::fetchConditions();
	
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
        
        $filter_categories = (array) $this->getState('filter.categories');
        if (!empty($filter_categories))
        {
        	$filter_categories = array_filter( array_values( $filter_categories ), function( $var ) {return !empty( trim($var) ); } );
        
        	if (!empty($filter_categories)) {
        		if( count( $filter_categories ) == 1 && $filter_groups[0] == '--' ) {
        			$this->setCondition('categories.id', array( '$size' => 0 ) );
        		} else {
        			$this->setCondition('categories.id', array( '$in' => $filter_categories ) );
        		}
        			
        	}
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


}