<?php var_dump($this->Session->read('ShoppingCart')); ?>

<table class="table table-condensed table-cart">
	<thead>
		<tr>
			<th>Tour</th>
			<th>Price</th>
			<th>Number</th>
			<th>Subtotal</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Tempura - Eel rice - Japanese tofu with seaweed</td>
			<td>&dollar;100.0</td>
			<td>
				<form id="form-update-10" action="ShoppingCart" method="post">
					<input type="hidden" name="itemid" value="10" />
					<input type="hidden" name="action" value="update" />
					<input type="hidden" id="input-itemnum-10" name="itemnum" value="1" />
					<select id="select-itemnum-10">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</form>
				<script type="text/javascript">
					var selectBox = '#select-itemnum-10';

					jQuery(selectBox).val(1);
					jQuery(selectBox).change(function() {
						jQuery('#input-itemnum-10').val(jQuery(this).val());
						jQuery('#form-update-10').submit();
					});
				</script>
			</td>
			<td>&dollar;100.0</td>
			<td>
				<form id="form-delete-10" action="ShoppingCart" method="post">
					<input type="hidden" name="item-price-10" value="100.0" />
					<input type="hidden" name="itemid" value="10" />
					<input type="hidden" name="action" value="delete" />
					<a href="#" onclick="jQuery('#form-delete-10').submit()" >Remove</a>
				</form>
			</td>
		</tr>

	</tbody>
</table>