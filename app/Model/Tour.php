<?php

App::uses('AppModel', 'Model');

class Tour extends AppModel {

	public $belongsTo = array('Destination');
//	public $hasMany = array('OrderItem');
	
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Name is required'
			)
		),
		'short_description' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Short description is required'
			)
		),
		'description' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Description is required'
			)
		),
	);

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