<?php

App::uses('AppController', 'Controller');

class DestinationsController extends AppController {

	public $paginate = array('limit' => 5);
	public $admin_paginate = array('limit' => 10);

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

	public function admin_index()
	{
		$destinations = $this->Paginator->paginate();

		$this->set(compact('destinations'));
	}

	public function admin_delete($id)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Destination->delete($id)) {
			$this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
	}

}
