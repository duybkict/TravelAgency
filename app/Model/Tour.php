<?php

App::uses('AppModel', 'Model');

class Tour extends AppModel {

	public $belongsTo = array('Destination');
	public $hasMany = array('OrderItem');

	public function beforeSave($options = array())
	{
		$isPublished = $this->data['Tour']['published'];

		if (!empty($isPublished) && $isPublished) {
			$this->data['Tour']['published_date'] = date('Y-m-d H:i:s');
		}
		return true;
	}

}