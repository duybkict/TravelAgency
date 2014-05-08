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
		if (isset($this->request->named['destination'])) {
			$this->Paginator->settings = array(
				'conditions' => array('destination_id' => $this->request->named['destination']),
				'limit' => 5
			);
		}
		$tours = $this->Paginator->paginate();

		$this->set(compact('tours'));
	}

}
