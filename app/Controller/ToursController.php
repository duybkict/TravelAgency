<?php

App::uses('AppController', 'Controller');

class ToursController extends AppController {

	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function index()
	{
		$tours = $this->Tour->find('all', array(
			'contain' => false,
			'recursive' => false
		));

		$this->set(compact('tours'));
	}

}
