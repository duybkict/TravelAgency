<?php

App::uses('AppModel', 'Model');

class Order extends AppModel {

	public $hasMany = array('OrderItem');
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
	);

}