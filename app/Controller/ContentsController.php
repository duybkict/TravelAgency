<?php

App::uses('AppController', 'Controller');

class DestinationsController extends AppController {

	public $components = array('Session', 'Auth');
	public $helpers = array('TinyMCE.TinyMCE');

	public function beforeFilter()
	{
		parent::beforeFilter();
	}

	public function admin_index()
	{	
		if (!empty($this->request->data)) {
			if ($this->Content->save($this->request->data)) {
				$this->Session->setFlash('Update content successfully', 'flash_success');
				return $this->redirect(array('controller' => 'contents', 'action' => 'index', 'admin' => true));
			} else {
				$this->Session->setFlash('Update failed', 'flash_error');
			}
		}

		$this->request->data = $this->Content->find('first');
		$this->layout = 'admin_default';
	}

}
