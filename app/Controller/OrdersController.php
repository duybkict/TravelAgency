<?php

App::uses('Controller', 'Controller');

class OrdersController extends AppController {

	public function addToCart($id, $quantity = 1)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if (!$id) {
			throw new NotFoundException(__('Invalid tour'));
		}

		$tour = $this->Tour->findById($id);
		if (!$tour) {
			throw new NotFoundException(__('Invalid tour'));
		}

		$this->Session->write("ShoppingCart.$id", array($tour, $quantity));
		
		return $this->getCart();
	}

	public function removeFromCart($id)
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		if (!$id) {
			throw new NotFoundException(__('Invalid tour'));
		}

		$this->Session->delete("ShoppingCart.$id");
		
		return $this->getCart();
	}

	public function getCart()
	{
//		if (!$this->request->is('post')) {
//			throw new MethodNotAllowedException();
//		}

		$this->set('shopping_cart', $this->Session->read('ShoppingCart'));
		$this->render('shopping_cart', 'ajax');
	}

}
