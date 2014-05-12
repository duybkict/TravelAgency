<?php

App::uses('AppController', 'Controller');

class DestinationsController extends AppController {

	public $paginate = array('limit' => 5);
	public $admin_paginate = array(
		'limit' => 10,
		'order' => array(
			'Destination.published_date' => 'desc',
			'Destination.modified' => 'desc',
			'Destination.created' => 'desc',
		)
	);
	public $helpers = array('TinyMCE.TinyMCE');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->set('title_for_layout', 'Bon Voyage | Destinations');
		$this->Auth->deny(array('admin_index', 'admin_edit', 'admin_delete'));
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

	public function admin_edit($id = null)
	{
//		if (!$id) {
//			throw new NotFoundException(__('Invalid record'));
//		}

		$destination = $this->Destination->findById($id);
//		if (!$destination) {
//			throw new NotFoundException(__('Invalid record'));
//		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Destination->id = $id;
			if ($this->Destination->save($this->request->data)) {
				$this->Session->setFlash(__('Update successfully.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Update failed.'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $destination;
		}
	}

	public function admin_delete($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Destination->delete($id)) {
			$this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
	}

}
