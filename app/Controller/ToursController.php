<?php

App::uses('AppController', 'Controller');

class ToursController extends AppController {

	public $paginate = array('limit' => 8);
	public $admin_paginate = array(
		'limit' => 10,
		'order' => array(
			'Tour.published_date' => 'desc',
			'Tour.modified' => 'desc',
			'Tour.created' => 'desc',
		)		
	);
	public $helpers = array('TinyMCE.TinyMCE');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->set('title_for_layout', 'Bon Voyage | Vacations');
		$this->Auth->deny(array('admin_index', 'admin_edit', 'admin_delete'));
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

	public function view($id)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid tour'));
		}

		$tour = $this->Tour->findById($id);
		if (!$tour) {
			throw new NotFoundException(__('Invalid tour'));
		}

		$random_tours = $this->Tour->getRandom(3);

		$this->set(compact('tour', 'random_tours'));
	}

	public function admin_index()
	{
		$tours = $this->Paginator->paginate();

		$this->set(compact('tours'));
	}
	
	public function admin_edit($id = null)
	{
//		if (!$id) {
//			throw new NotFoundException(__('Invalid record'));
//		}

		$tour = $this->Tour->findById($id);
//		if (!$tour) {
//			throw new NotFoundException(__('Invalid record'));
//		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Tour->id = $id;
			if ($this->Tour->save($this->request->data)) {
				$this->Session->setFlash(__('Update successfully.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Update failed.'));
		}
		
		if (!$this->request->data) {
			$this->request->data = $tour;
		}
	}
	
	public function admin_delete($id)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Tour->delete($id)) {
			$this->Session->setFlash(__('The tour with id: %s has been deleted.', h($id)), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
	}

}
