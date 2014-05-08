<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class ImagesController extends AppController {

	public $components = array('Session', 'Auth', 'Thumb');

	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Thumb->set_paths(WWW_ROOT . 'img' . DS . 'gallery' . DS, WWW_ROOT . 'img' . DS . 'thumb' . DS);
		$this->Thumb->set_zoom_crop('C');
		$this->Thumb->width = 140;
		$this->Thumb->height = 140;
	}

	public function admin_index()
	{
		$this->layout = 'admin_default';

		if ($this->request->is('post')) {
			$upload = $this->Thumb->upload_image('Image.image');
			if (empty($upload)) {
				$this->Session->setFlash('Cannot upload image', 'flash_error');
			}
			$this->request->data['Image']['image'] = $this->processPath($upload);

			$thumb = $this->Thumb->thumb($upload);
			if (empty($thumb)) {
				$this->Session->setFlash('Resize image failed', 'flash_error');
			}
			$this->request->data['Image']['thumbnail'] = $this->processPath($thumb);

			if ($this->Image->save($this->request->data)) {				
				$this->Session->setFlash('Save image successfully', 'flash_success');
				return $this->redirect(array('controller' => 'images', 'action' => 'index', 'admin' => true));
			} else {
				$this->Session->setFlash('Resize image failed', 'flash_error');
			}
		}

		$images = $this->Image->find('all');

		$this->set(compact('images'));
	}
	
	public function admin_delete($id) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		if ($this->Image->delete($id)) {
			$this->Session->setFlash('Delete image successfully', 'flash_success');
			return $this->redirect(array('controller' => 'images', 'action' => 'index', 'admin' => true));
		} else {
			$this->Session->setFlash('Delete image failed', 'flash_error');
		}
	}
	
	private function processPath($path) {
		$imgRoot = WWW_ROOT . 'img' . DS;
		
		$path = str_replace($imgRoot, '', $path);
		$path = str_replace('\\', '/', $path);
		
		return $path;
	}

}
