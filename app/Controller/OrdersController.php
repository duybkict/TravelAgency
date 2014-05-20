<?php

App::uses('Controller', 'Controller');

class OrdersController extends AppController {

	public $uses = array('Tour', 'Order', 'OrderItem');
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->deny('admin_index', 'admin_edit', 'admin_delete');
	}

	public function addToCart($id, $quantity = null)
	{
		if ($this->request->is('get')) {
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
		if ($this->request->is('get')) {
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
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$this->set('shoppingCart', $this->Session->read('ShoppingCart'));
		$this->render('shopping_cart', 'ajax');
	}

	public function checkout()
	{
		if ($this->request->is('get')) {
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
	
	public function admin_index()
	{
		$orders = $this->Paginator->paginate('Order');

		$this->set(compact('orders'));
	}
	
	public function admin_edit($id)
	{
		if (!$id) {
			throw new NotFoundException(__('Invalid record'));
		}

		$order = $this->Order->findById($id);
		if (!$order) {
			throw new NotFoundException(__('Invalid record'));
		}

		if ($this->request->is(array('post', 'put'))) {
			$this->Order->id = $id;
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('Update successfully.'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Update failed.'));
		}
		
		foreach ($order['OrderItem'] as $k => $item) {
			$item['Tour'] = $this->Tour->findById($item['tour_id'])['Tour'];
			$order['OrderItem'][$k] = $item;
		}
		
		if (!$this->request->data) {
			$this->request->data = $order;
		}
	}

	public function admin_delete($id)
	{
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if ($this->Order->delete($id)) {
			$this->Session->setFlash(__('The order with id: %s has been deleted.', h($id)), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
	}

}
