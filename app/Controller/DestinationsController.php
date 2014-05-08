<?php

App::uses('AppController', 'Controller');

class DestinationsController extends AppController {

	public $paginate = array(
		'limit' => 5,
	);

	public function beforeRender()
	{
		parent::beforeRender();
		$this->set('title_for_layout', 'Bon Voyage | Destinations');
	}

	public function index()
	{
		$destinations = $this->Paginator->paginate();

		$this->set(compact('destinations'));
	}

}
