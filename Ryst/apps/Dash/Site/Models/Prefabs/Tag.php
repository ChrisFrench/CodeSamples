<?php 
namespace Dash\Site\Models\Prefabs;


Class Tag {
	var $type = '';
	var $status = 'generated'; //inactive active redeemed
	var $name = ''; //concert Name
	var $eventDate = ''; 
	var $url = null;
	var $listname = null;

	public function __construct($params = array()) {
		
		$date = New \DateTime();
		$this->createdDate = $date->format('Y-m-d H:i:s');

		$date = New \DateTime('2014-12-15 17:45:12');
		$this->eventDate = $date->format('g:ia \o\n l jS F Y');;


		if(!empty($params['values'])) {
			foreach ($params['values'] as $key => $value) {
				$this->$key = $value;
			}
		}
	}




}

?>