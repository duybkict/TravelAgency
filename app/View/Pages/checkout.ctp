<?php
$ajax = $this->Js->request(
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
					<a href="#" onclick='<?php echo $ajax; ?>;return false;'>Click</a>
				</div>
			</div>
		</div>

		<div class="checkout-right-col pull-right">		
			<div class="intro text-center">
				<span>Expert Travel Knowledge</span>
				<span class="dashed"></span>
				<span>Tailor-Made Holidays</span>
				<span class="dashed"></span>
				<span>Global Reach</span>
				<span class="dashed"></span>
				<span>100%  Money Protected</span>
			</div>
		</div>
	</div>
</div>

<div class="div-space" style="margin-top: 21px;"></div>