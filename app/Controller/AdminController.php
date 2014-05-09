<?php

App::uses('AppController', 'Controller');

class AdminController extends AppController {

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->deny('*');
	}
	
	public function admin_index()
	{		
	}

}
