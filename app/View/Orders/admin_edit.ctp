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

	<table class="table table-bordered">
		<thead>
			<th>Name</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Subtotal</th>
		</thead>
		<tbody>
			<?php 
				$total = 0;
				foreach ($this->request->data['OrderItem'] as $item) : 
				$subtotal = $item['price'] * $item['quantity'];
				$total += $subtotal;?>
				<tr>
					<td><?php echo $item['Tour']['details'] . ': ' . $item['Tour']['name']; ?></td>
					<td><?php echo $item['quantity']; ?></td>
					<td><?php echo '$' . $item['price']; ?></td>
					<td>
						<?php echo '$' . $subtotal; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<h4><strong>Total: </strong> <?php echo '$' . $total; ?></h4>

	<?php echo $this->Form->end('Save'); ?>

</div>