<?php
$ajax_addToCart = $this->Js->request(
	array('controller' => 'orders', 'action' => 'addToCart', $tour['Tour']['id']), array('async' => true, 'method' => 'POST')
);
?>

<div class="div-content col-xs-12">
	<div class="container">

		<h1 class="page-title" style="margin-bottom: 25px">BOOK A TOUR</h1>

		<div class="vacation-left-col pull-left">
			<div class="white-content">
				<?php echo $this->Html->image($tour['Tour']['image']); ?>
				<div class="wrap">
					<h2><?php echo $tour['Tour']['name']; ?></h2>
					<p class="details"><?php echo $tour['Tour']['details']; ?></p>
					<strong><?php echo $tour['Tour']['short_description']; ?></strong>
					<div class="div-book">
						<span class="pull-left">Book now for only <strong>&dollar;<?php echo $tour['Tour']['price']; ?></strong> each person</span>
						<a class="btn btn-success" href="<?php echo $this->Html->url('/pages/checkout');?>" onclick='<?php echo $ajax_addToCart; ?>'>
							Add to Cart
						</a>
						<div class="clearfix"></div>
					</div>
					<?php echo $tour['Tour']['description']; ?>
					<a href="<?php echo $this->Html->url(array('controller' => 'tours', 'action' => 'index', 'anchor' => 'anchor-main', 'destination' => $tour['Destination']['id'])); ?>">
						&ll; Look out for more <?php echo $tour['Destination']['name']; ?> tours
					</a>
				</div>
			</div>
		</div>

		<div class="vacation-right-col pull-right">
			<div class="intro">
				<p>Bon Voyage offers travel information on a wide range of destinations.</p>
				<p>There might be some other tours that you interested in. </p>
			</div>

			<?php foreach ($random_tours as $rt) : ?>
				<h2>&dollar;<?php echo $rt['Tour']['price']; ?></h2>
				<div class="white-content">
					<p><?php echo $this->Text->truncate($rt['Tour']['name'].': '.$rt['Tour']['details'], 50); ?></p>
					<?php echo $this->Html->link('+', array(
						'controller' => 'tours', 
						'action' => 'view',
						$rt['Tour']['id']
					), array('class' => 'seemore')); ?>
					<div class="border-bottom"></div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="clearfix"></div>

	</div>
</div>

<div class="div-space" ></div>