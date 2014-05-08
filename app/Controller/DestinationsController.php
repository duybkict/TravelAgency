<?php

App::uses('AppController', 'Controller');

class DestinationsController extends AppController {

	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function index()
	{
		$destinations = $this->Destination->find('all', array(
			'contain' => false,
			'recursive' => false
		));

		$this->set(compact('destinations'));
	}

}
