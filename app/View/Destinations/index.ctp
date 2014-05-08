<div class="div-content col-xs-12">
	<div class="container">

		<h1 class="page-title">DESTINATIONS</h1>

		<div class="destinations-left-col pull-left">
			<?php echo $this->Html->image('slide1.jpg'); ?>
		</div>

		<div class="destinations-right-col text-center pull-right">
			<?php echo $this->Html->image('briefcase.png', array('style' => 'margin: 38px auto 5px')); ?>
			<a href="<?php echo $this->Html->url(array('controller' => 'tours', 'anchor' => 'anchor-main')); ?>" class="banner">START</a>
			<span>The Adventure</span>
		</div>

		<div class="clearfix"></div>

		<div class="div-space2"><a id="anchor-main" ></a></div>

		<div class="destinations-left-col-1 pull-left">
			<h2>World Destinations</h2>
			<?php echo $this->Html->image('plane.png', array('class' => 'h2-icon')); ?>
			
			<?php foreach ($destinations as $d) : ?>
				<div class="destination-item">
					<div class="wrap pull-left">
						<h3><?php echo $d['Destination']['name']; ?></h3>
						<p><?php echo $this->Text->truncate($d['Destination']['description'], 130, array('exact' => false)); ?></p>
					</div>
					<a href="<?php echo $this->Html->url(array('controller' => 'tours', 'anchor' => 'anchor-main', 'destination' =>  $d['Destination']['id'])); ?>" >
						<?php echo $this->Html->image($d['Destination']['image']); ?>
					</a>						
					<a href="<?php echo $this->Html->url(array('controller' => 'tours', 'anchor' => 'anchor-main', 'destination' =>  $d['Destination']['id'])); ?>" class="seemore">&plus;</a>
				</div>
			<?php endforeach; ?>
			
			<ul class="pagination pull-right">
				<?php
				echo $this->Paginator->numbers(array(
					'tag' => 'li',
					'separator' => '',
					'currentTag' => 'a'
				));
				?>
			</ul>

		</div>

		<div class="destinations-right-col-1 text-center pull-right">
			<p class="p-intro">FIND SUGGESTED HOTELS, DAY TRIPS & ADVENTURE TIPS</p>

			<div class="div-intro">
				Bon Voyage offers travel information on a wide range of destinations. Learn about your destination today and contact us for more information.
			</div>

			<h2>Need Help?</h2>
			<?php echo $this->Html->image('help.png', array('class' => 'h2-icon')); ?>

			<div class="white-content">
				<p>Booking a major trip is exciting, but it can also be a bit overwhelming. </p>
				<p>We understand. That's why we have live Travel Experts here to take care of your every need, making your trip stress-free & amazing.</p>
				<strong style="margin-top: 10px;">Call Us Today </strong>
				<strong>1-800-000-0000</strong>
				<div class="border-bottom"></div>
			</div>
		</div>
	</div>
</div>

<div class="div-space2"></div>