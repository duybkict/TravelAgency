<div class="div-content col-xs-12">
	<div class="container">

		<div class="home-left-col text-center pull-left">
			<div class="social-icons">
				<a href="http://www.facebook.com" target="_blank"><?php echo $this->Html->image('facebook.png'); ?></a>
				<a href="http://www.twitter.com" target="_blank"><?php echo $this->Html->image('twitter.png'); ?></a>
				<a href="http://plus.google.com" target="_blank"><?php echo $this->Html->image('googleplus.png'); ?></a>
				<a href="http://www.pinterest.com" target="_blank"><?php echo $this->Html->image('pinterest.png'); ?></a>
			</div>
			<?php echo $this->Html->image('binoculars.png', array('style' => 'margin-bottom: 18px')); ?>
			<a href="<?php echo $this->Html->url(array('controller' => 'tours', 'anchor' => 'anchor-main')); ?>" class="banner">SEARCH</a>
			<span>For A Holiday</span>
			<a href="<?php echo $this->Html->url('/pages/aboutus'); ?>" class="btn-custom" style="width: 100%">
				WELCOME TO OUR WORLD
			</a>
		</div>

		<div class="home-right-col pull-right">
			<p>SEE HOW MUCH <br/>YOU CAN SAVE WITH THESE LAST MINUTE BON VOYAGE<br/> RATES.</p>
			<a href="#anchor-main" class="pull-right" style="margin-top: 5px;">See Details &nbsp;&nbsp;<span class="seemore">&plus;</span></a>
		</div>

		<div class="clearfix"></div>

		<div class="div-space"></div>
		<a id="anchor-main" ></a>

		<div class="home-left-col-1 pull-left">
			<h2>Latest Offers</h2>
			<?php echo $this->Html->image('clock.png', array('class' => 'h2-icon')); ?>
			<div class="white-content">
				<?php foreach ($newest_tours as $nt) : 
					$padlen = 28 - strlen($nt['Tour']['name']);?>
					<span class="list-details">
						<?php echo $nt['Tour']['name']; ?>
						<span class="color-white"><?php echo str_pad('', $padlen, '-')?></span>
						&dollar;<?php echo $nt['Tour']['price']; ?>
					</span>
				<?php endforeach; ?>
				
				<a href="<?php echo $this->Html->url(array('controller' => 'tours')); ?>" class="link-seemore">
					See more &nbsp;<span class="seemore">&plus;</span>
				</a>
			</div>

			<h2>Favor Destinations</h2>
			<?php echo $this->Html->image('plane.png', array('class' => 'h2-icon')); ?>
			<div class="white-content" style="margin-bottom: 3px;">
				<?php foreach ($cheapest_tours as $ct) : 
					$padlen = 28- strlen($ct['Tour']['name']);?>
					<span class="list-details">
						<?php echo $ct['Tour']['name']; ?>
						<span class="color-white"><?php echo str_pad('', $padlen, '-')?></span>
						&dollar;<?php echo $ct['Tour']['price']; ?>
					</span>
				<?php endforeach; ?>
				<a href="<?php echo $this->Html->url(array('controller' => 'destinations')); ?>" class="link-seemore">
					See more &nbsp;<span class="seemore">&plus;</span>
				</a>
			</div>
		</div>

		<div class="home-right-col-1 pull-right">
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
	</div>
</div>

<div class="div-space"></div>