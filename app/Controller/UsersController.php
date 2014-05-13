<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $admin_paginate = array(
		'limit' => 10,
		'order' => array(
			'User.modified' => 'desc',
			'User.created' => 'desc',
		)		
	);

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->deny('admin_logout', 'admin_index');
		
		$this->layout = 'admin_default';
	}

	public function admin_login()
	{	
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Incorrect email or password'), 'flash_error');
			}
		}		
	}

	public function admin_logout()
	{		
		$this->Session->setFlash(__('Logout successfully'), 'flash_success');
		return $this->redirect($this->Auth->logout());
	}
	
	public function admin_index()
	{
		$users = $this->Paginator->paginate();

		$this->set(compact('users'));
	}

}
