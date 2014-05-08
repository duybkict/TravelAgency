<?php

App::uses('AppController', 'Controller');

class ToursController extends AppController {

	public $paginate = array(
		'limit' => 8,
	);

	public function beforeRender()
	{
		parent::beforeRender();
		$this->set('title_for_layout', 'Bon Voyage | Vacations');
	}

	public function index()
	{
		$tours = $this->Paginator->paginate();

		$this->set(compact('tours'));
	}

}
