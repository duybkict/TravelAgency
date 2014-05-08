<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $uses = array();
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array('controller' => 'pages', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
		)
	);

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('logout');
	}

	public function admin_login()
	{
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Username or password is incorrect'), 'flash_error');
			}
		}
	}

	public function admin_logout()
	{
		$this->Session->setFlash(__('Logout successfully'), 'flash_success');
		return $this->redirect($this->Auth->logout());
	}

}
