<?php

App::uses('AppModel', 'Model');

class Destination extends AppModel {
	public $hasMany = array('Tour');
	
	public function beforeSave($options = array())
	{
		$isPublished = $this->data['Destination']['published'];

		if (!empty($isPublished) && $isPublished) {
			$this->data['Destination']['published_date'] = date('Y-m-d H:i:s');
		}
		return true;
	}
}