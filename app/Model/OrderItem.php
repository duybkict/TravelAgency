<?php

App::uses('AppModel', 'Model');

class OrderItem extends AppModel {
	public $belongsTo = array('Order', 'Tour');
}