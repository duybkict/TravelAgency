<?php if (empty($shoppingCart)) : ?>
Cart is empty. You might want to go <a href="<?php echo $this->Html->url(array('controller' => 'tours', 'action' => 'index', 'anchor' => 'anchor-main'));?>" class="link-back">explore for more adventures.</a>
<?php else : ?>

<table class="table table-condensed table-cart">
	<thead>
		<tr>
			<th>Tours</th>
			<th>Price</th>
			<th>Quantity</th>
			<th width="1%">Subtotal</th>
			<th width="1%"></th>
		</tr>
	</thead>
	<tbody>
		
		<?php $total = 0;foreach ($shoppingCart as $i) : ?>
			<tr>
				<td><?php echo $i[0]['Tour']['name'] . ': ' . $i[0]['Tour']['details']; ?></td>
				<td>&dollar;<?php echo $i[0]['Tour']['price']; ?></td>
				<td>
					<select>
						<?php
						for ($j = 1; $j <= 20; $j++) {
							$ajax_addToCart = $this->Js->request(
								array('controller' => 'orders', 'action' => 'addToCart', $i[0]['Tour']['id'], $j), array('async' => true, 'update' => '#shopping_cart', 'method' => 'POST')
							);
							$selected = ($j == $i[1]) ? 'selected=selected' : '';
							echo "<option value=$j $selected onclick='$ajax_addToCart'>$j</option>";
						}
						?>
					</select>
				</td>
				<?php $subtotal = $i[0]['Tour']['price'] * $i[1]; $total += $subtotal;?>
				<td class="text-right">&dollar;<?php echo $subtotal?></td>
				<td>
					<?php
					$ajax_removeFromCart = $this->Js->request(
						array('controller' => 'orders', 'action' => 'removeFromCart', $i[0]['Tour']['id']), array('async' => true, 'update' => '#shopping_cart', 'method' => 'POST')
					);
					?>
					<a href="#" onclick='if (confirm("Are you sure?"))
					<?php echo $ajax_removeFromCart; ?>;return false;' class="btn btn-danger btn-sm" >Remove</a>
				</td>
			</tr>
		<?php endforeach; ?>
			
	</tbody>
	<tfoot>
		<tr>
			<th><strong>Total</strong></th>
			<th></th>
			<th></th>
			<th class="text-right"><strong>&dollar;<?php echo $total; ?></strong></th>
			<th></th>
		</tr>
	</tfoot>
</table>

<?php endif;?>