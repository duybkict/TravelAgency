<?php

App::uses('AppModel', 'Model');

class Order extends AppModel {
	public $hasMany = array('OrderItem');
}