<div class="div-content col-xs-12">
	<div class="container">

		<h1 class="page-title" style="margin-bottom: 25px">WHO WE ARE</h1>

		<div class="checkout-left-col pull-left">
			<div class="white-content">
				<div class="wrap">
					<h2>Shopping Cart</h2>
					<div id="post">
					</div>
					<?php $ajax = $this->Js->request(
						array( 'controller' => 'orders', 'action' => 'getCart'),
						array( 'update' => 'post')
					);
//					echo $ajax;
					?>
					
					<a href="#" onclick='alert("a");<?php echo $ajax; ?>;return false;'>Click</a>
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