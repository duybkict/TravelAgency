<?php

App::uses('AppModel', 'Model');

class Tour extends AppModel {

	public $belongsTo = array('Destination');
//	public $hasMany = array('OrderItem');

	public function beforeSave($options = array())
	{
		$isPublished = $this->data['Tour']['published'];

		if (!empty($isPublished) && $isPublished) {
			$this->data['Tour']['published_date'] = date('Y-m-d H:i:s');
		}
		return true;
	}
	
	public function getRandom($limit = 1) {
		return $this->find('all', array(
			'limit' => $limit,
			'order' => 'rand()'
		));
	}
	
	public function getNewest($limit = 1) {
		return $this->find('all', array(
			'limit' => $limit,
			'order' => 'Tour.published_date'
		));
	}

}