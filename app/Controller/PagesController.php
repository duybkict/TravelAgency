<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public $uses = array('Tour', 'Destination');

	function display()
	{
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		switch ($page) {
			case 'index':
				$this->_home();
				$this->render('index');
				break;
			default:
				$this->render(implode('/', $path));
		}
	}

	public function index()
	{
		$title_for_layout = 'Bon Voyage | Travel Agency';

		$this->set(compact('title_for_layout'));
	}

	public function aboutus()
	{
		$title_for_layout = 'Bon Voyage | About Us';

		$this->set(compact('title_for_layout'));
	}

	public function admin_index()
	{
		$this->layout = 'admin_default';
	}

}
