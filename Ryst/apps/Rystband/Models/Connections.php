<?php

namespace Rystband\Models;

class Connections extends \Dsc\Mongo\Collection {
	var $connecter = null;
	var $connected = null;
	var $event = null;
	var $type = null;
	var $timestamp = null;
	protected $__collection_name = 'connections';
	protected function fetchConditions() {
		parent::fetchConditions ();
		
		$filter_keyword = $this->getState ( 'filter.keyword' );
		if ($filter_keyword && is_string ( $filter_keyword )) {
			$key = new \MongoRegex ( '/' . $filter_keyword . '/i' );
			
			$where = array ();
			$where [] = array (
					'name' => $key 
			);
			$where [] = array (
					'slug' => $key 
			);
			$where [] = array (
					'event_id' => $key 
			);
			$where [] = array (
					'start_date' => $key 
			);
			$where [] = array (
					'end_date' => $key 
			);
			
			$this->setCondition ( '$or', $where );
		}
		
		$filter_id = $this->getState ( 'filter.id' );
		
		if (strlen ( $filter_id )) {
			$this->setCondition ( '_id', new \MongoId ( ( string ) $filter_id ) );
		}
		$filter_connecter_id = $this->getState ( 'filter.connecter_id' );
		
		if (strlen ( $filter_connecter_id )) {
			$this->setCondition ( 'connecter.id', new \MongoId ( ( string ) $filter_connecter_id ) );
		}
		if (strlen ( $filter_connected_id )) {
			$this->setCondition ( 'connected.id', new \MongoId ( ( string ) $filter_connected_id ) );
		}
		
		$filter_eventid = $this->getState ( 'filter.eventid' );
		if (strlen ( $filter_eventid )) {
			$this->setCondition ( 'event.id', new \MongoId ( ( string ) $filter_eventid ) );
		}
		
		return $this;
	}
	public static function makeConnectionID($connecter, $connected) {
		$array = array (
				$connecter,
				$connected 
		);
		natsort ( $array );
		return implode ( '.', $array );
	}
	public static function makeConnection($connecter, $connected, $event = null) {
		if (! $connecter instanceof \Rystband\Models\Users || ! $connecter instanceof \Users\Models\Users) {
			if (strlen ( ( string ) $connecter ) == 24) {
				$connecter = (new \Rystband\Models\Users ())->setState ( 'filter.id', $connecter )->getItem ();
				if (empty ( $connecter->id )) {
					throw new \Exception ( 'Connector is Invalid' );
				}
			}
		}
		
		if (! $connected instanceof \Rystband\Models\Users || ! $connected instanceof \Users\Models\Users) {
			if (strlen ( ( string ) $connected ) == 24) {
				$connected = (new \Rystband\Models\Users ())->setState ( 'filter.id', $connected )->getItem ();
				if (empty ( $connected->id )) {
					throw new \Exception ( 'Connected is Invalid' );
				}
			}
		}
		
		try {
			$model = new static ();
			$model->connectionid = static::makeConnectionID ( $connecter->id, $connected->id );
			$model->connecter = array (
					'id' => $connecter->id,
					'name' => $connecter->fullName (),
					'img' => $connecter->profilePicture () 
			);
			$model->connected = array (
					'id' => $connected->id,
					'name' => $connected->fullName (),
					'img' => $connecter->profilePicture () 
			);
			$model->event = $event;
			$model->store ();
		} catch ( \Exception $e ) {
		}
		
		return true;
	}
	public static function makeConnectionLink($connecter, $connected, $event = null) {
		$html = '';
		
		if (! $connecter instanceof \Rystband\Models\Users || ! $connecter instanceof \Users\Models\Users) {
			if (strlen ( ( string ) $connecter ) == 24) {
				$connecter = (new \Rystband\Models\Users ())->setState ( 'filter.id', $connecter )->getItem ();
				if (empty ( $connecter->id )) {
					throw new \Exception ( 'Connector is Invalid' );
				}
			}
		}
		
		if (! $connected instanceof \Rystband\Models\Users || ! $connected instanceof \Users\Models\Users) {
			if (strlen ( ( string ) $connected ) == 24) {
				$connected = (new \Rystband\Models\Users ())->setState ( 'filter.id', $connected )->getItem ();
				if (empty ( $connected->id )) {
					throw new \Exception ( 'Connected is Invalid' );
				}
			}
		}
		
		$html .= '/connection/' . $connecter->id . '/' . $connected->id . '/';
		if (! empty ( $event )) {
			$html .= $event->id;
		} else {
			$html .= '0';
		}
		
		// TODO do we want to do some sort of hash to something
		
		return $html;
	}
	public static function checkConnection($connecter, $connected, $event = null) {
		try {
			
			$id = static::makeConnectionID ( $connecter, $connected );
			
			$doc = static::collection ()->findOne ( array (
					'connectionid' => $id 
			)
			 );
			
			if (! empty ( $doc )) {
				return true;
			} else {
				return false;
			}
		} catch ( \Exception $e ) {
			echo $e->getMessage ();
		}
	}

	public static function getConnectionsByUser( $user, $limit = 10, $skip = 0 )
    {
    	try {
    		
    		$docs = static::collection()->find(array(
    				'$or' => array(
    				array('connecter.id' => array( '$in' => array(new \MongoId( (string) $user)))
    				),
    				array('connected.id' => array( '$in' => array(new \MongoId( (string) $user)))
    				))
    		
    		))->skip($skip)->limit($limit);
    		
    		if(!empty($docs)) {
    			return $docs;
    		} else {
    			return array();
    		}
    		
    		
    	} catch (\Exception $e) {
    		echo $e->getMessage();
    	}
    }

	
}
?>