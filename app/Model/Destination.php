<?php

App::uses('AppModel', 'Model');

class Destination extends AppModel {
	public $hasMany = array('Tour');
	
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Name is required'
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
		$isPublished = $this->data['Destination']['published'];

		if (!empty($isPublished) && $isPublished) {
			$this->data['Destination']['published_date'] = date('Y-m-d H:i:s');
		}
		return true;
	}
	
}