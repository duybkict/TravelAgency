<?php

App::uses('Controller', 'Controller');

class OrdersController extends AppController {

	public $uses = array('Tour', 'Order', 'OrderItem');

	public function addToCart($id, $quantity = null)
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
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$this->set('shoppingCart', $this->Session->read('ShoppingCart'));
		$this->render('shopping_cart', 'ajax');
	}

	public function checkout()
	{
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$success = true;
		$transaction = $this->Order->getDataSource();
		$transaction->begin();

		$this->request->data['Order']['status'] = 1;
		$this->Order->create();
		if ($this->Order->save($this->request->data)) {
			$orderId = $this->Order->id;

			foreach ($this->Session->read('ShoppingCart') as $i) {
				$item = array(
					'OrderItem' => array(
						'tour_id' => $i[0]['Tour']['id'],
						'order_id' => $orderId,
						'quantity' => $i[1],
						'price' => $i[0]['Tour']['price'],
					)
				);
				$this->OrderItem->create();
				if (!$this->OrderItem->save($item)) {
					$success = false;
					break;
				}
			}
		} else {
			$success = false;
		}

		if ($success) {
			$transaction->commit();
			$this->Session->delete('ShoppingCart');
			$this->Session->setFlash(__('Checkout successfully!'), 'flash_success');
		} else {
			$transaction->rollback();
			$this->Session->setFlash(__('Unable to checkout!'), 'flash_error');
		}

		return $this->redirect(array('controller' => 'pages', 'action' => 'checkout'));
	}

}
