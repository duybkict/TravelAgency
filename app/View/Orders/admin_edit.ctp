<?php $statusOptions = array('Pending', 'Confirmed', 'Canceled'); ?>

<div class="col-xs-12 well content">
	<?php if (empty($this->request->data)) : ?>
		<h1>Add new Order</h1>
	<?php else : ?>
		<h1>Edit Order</h1>
	<?php endif; ?>

	<?php
	echo $this->Session->flash();
	
	echo $this->Form->create('Order');
	echo $this->Form->input('email', array('disabled' => true));
	echo $this->Form->input('status', array('type' => 'select', 'options' => $statusOptions));
	echo $this->Form->input('id', array('type' => 'hidden'));
	?>
	
	<table>
	<?php foreach ($this->request->data['OrderItem'] as $item) : var_dump($item); ?>
		<tr>
			<td><?php echo $item['Tour']['details'].': '.$item['Tour']['name']; ?></td>
			<td><?php echo '$'.$item['Tour']['price']; ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	
	<?php echo $this->Form->end('Save'); ?>

</div>