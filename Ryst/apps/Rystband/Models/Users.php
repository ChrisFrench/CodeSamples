<?php

namespace Rystband\Models;

class Users extends \Users\Models\Users {
	protected function fetchConditions() {
		parent::fetchConditions ();
		
		$filter_rystbandid = $this->getState ( 'filter.rystbandid' );
		if (strlen ( $filter_rystbandid )) {
			$this->setCondition ( 'rystband.id', new \MongoId ( ( string ) $filter_rystbandid ) );
		}
		
		$filter_rystband = $this->getState ( 'filter.rystband' );
		if (strlen ( $filter_rystband )) {
			$this->setCondition ( 'rystband.tagid', $filter_rystband );
		}
		
		return $this;
	}
	public function addRystband(\Rystband\Models\Rystbands $band) {
		if (empty ( $band )) {
			return;
		}
		
		$bands = $this->{'rystbands'};
		if (! is_array ( $bands )) {
			$bands = array ();
		}
		$bands [] = array (
				'id' => $band->id,
				'tagid' => $band->tagid,
				'event' => $band->event 
		);
		$this->set ( 'rystbands', $bands );
		$this->save ();
		
		$attendee = array (
				'id' => $this->id,
				'name' => $this->fullName () 
		);
		$band->set ( 'attendee', $attendee );
		$band->save ();
	}
	public function makeConnection(\Rystband\Models\Users $user, $event = null) {
		if (empty ( $user )) {
			return;
		}
		
		$connection = \Rystband\Models\Connections::makeConnection ( $this, $user, $event );
	}
	public function getConnections($limit = 10) {
		$array = array ();
		$docs = \Rystband\Models\Connections::getConnectionsByUser ( $this->id, $limit );
		
		foreach ( $docs as $connection ) {
			if (( string ) $connection ['connecter'] ['id'] == ( string ) $this->id) {
				$array [] = $connection ['connected'];
			} else {
				$array [] = $connection ['connecter'];
			}
		}
		return $array;
	}
	
	/**
	 * Returns link to user's profile picture
	 *
	 * @return Either link to the image, or an empty string
	 */
	public function profilePicture($img = '/image/avatar.png') {
		if ($this->{'avatar.slug'}) {
			
			return '/asset/thumb/' . $this->{'avatar.slug'};
		}
		
		$networks = ( array ) $this->{'social'};
		foreach ( $networks as $network ) {
			if ($photo_url = \Dsc\ArrayHelper::get ( $network, 'profile.photoURL' )) {
				$img = $photo_url;
				break;
			}
		}
		
		return $img;
	}
	
	public function isEmployee() {
		$return = false;
		if($this->role == 'employee') {
			$return = true;
		}
		return $return;
	}
}