<?php

App::uses('Controller', 'Controller');

class OrdersController extends AppController {
	
	public $uses = array('Tour');

	public function addToCart($id, $quantity = null)
	{
//		if (!$this->request->is('post')) {
//			throw new MethodNotAllowedException();
//		}

		if (!$id) {
			throw new NotFoundException(__('Invalid tour'));
		}

		$tour = $this->Tour->findById($id);
		if (!$tour) {
			throw new NotFoundException(__('Invalid tour'));
		}

		if ($this->Session->check("ShoppingCart.$id")) {
			if ($quantity) {
				$this->Session->write("ShoppingCart.$id", array($tour, $quantity));
			}
		} else {
			$quantity = empty($quantity) ? 1 : $quantity;
			$this->Session->write("ShoppingCart.$id", array($tour, $quantity));
		}		
		
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

		$this->set('shoppingCart', $this->Session->read('ShoppingCart'));
		$this->render('shopping_cart', 'ajax');
	}

}
