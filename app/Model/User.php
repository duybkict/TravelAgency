<?php

App::uses('AppModel', 'Model');
App::uses('Security', 'Utility');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $validate = array(
		'email' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Eamil is required'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'Please supply a valid email address'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'Password is required'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList', array('admin', 'guest')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);

	public function beforeSave($options = array())
	{
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new SimplePasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
					$this->data[$this->alias]['password']
			);
		}
		return true;
	}
}