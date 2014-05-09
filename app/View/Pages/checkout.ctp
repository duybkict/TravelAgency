<?php
$ajax_getCart = $this->Js->request(
	array('controller' => 'orders', 'action' => 'getCart'), array('async' => true, 'update' => '#shopping_cart', 'method' => 'POST')
);
?>

<div class="div-content col-xs-12">
	<div class="container">

		<h1 class="page-title" style="margin-bottom: 25px">CHECK OUT</h1>

		<div class="checkout-left-col">
			<div class="white-content">
				<div class="wrap">
					<h2>Shopping Cart</h2>
					<div id="shopping_cart">
					</div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="div-space" style="margin-top: 21px;"></div>

<script type="text/javascript" >
	$(document).ready(function() {
		<?php echo $ajax_getCart; ?>
	});
</script>