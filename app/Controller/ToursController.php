<?php

App::uses('AppController', 'Controller');

class ToursController extends AppController {
	
	public $components = array('Paginator');

    public $paginate = array(
        'limit' => 8,
    );

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Paginator->settings = $this->paginate;		
	}
	
	public function beforeRender()
	{
		parent::beforeRender();
		$this->set('title_for_layout', 'Bon Voyage | Vacations');
	}

	public function index()
	{
		$tours = $this->Paginator->paginate('Tour');

		$this->set(compact('tours'));
	}

}
