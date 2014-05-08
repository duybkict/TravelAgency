<div class="div-content col-xs-12">
	<div class="container">

		<h1 class="page-title">VACATIONS <?php if (isset($destination)) echo " - $destination->name TOURS"; ?></h1>

		<div class="vacations-left-col text-center pull-left">
			<?php echo $this->Html->image('sandals.png', array('style' => 'margin: 38px auto 15px')); ?>
			<br/>
			<span>EXPLORE.<br/>DREAM.<br/>DISCOVER.</span>
		</div>

		<div class="vacations-right-col text-center pull-right">
			<?php echo $this->Html->image('slide1.jpg'); ?>		
		</div>

		<div class="clearfix"></div>

		<div class="div-space2"><a id="anchor-main" ></a> </div>

		<?php if (empty($tours)) : ?>
			<div class="vacation-item-empty">
				<h2>No <?php if (isset($destination)) echo "$destination->name"; ?> tours available!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.</p>
				<a href="<?php echo $this->Html->url(array('controller' => 'tours', 'anchor' => 'anchor-main')); ?>">&ll; Go explore another options</a>
			</div>
		<?php else: ?>

			<?php // var_dump($tours); ?>

			<?php foreach ($tours as $k => $t) : ?>
				<div class="vacation-item <?php if (($k + 1) % 4 == 0) echo 'last'; ?>">
					<?php echo $this->Html->image($t['Tour']['thumbnail']); ?>
					<div class="wrap">
						<h2>$<?php echo $t['Tour']['price']; ?></h2>
						<strong><?php echo $t['Tour']['name']; ?>:</strong>
						<span><?php echo $t['Tour']['details']; ?></span>
						<p><?php echo $this->Text->truncate($t['Tour']['description'], 200, array('exact' => false)); ?></p>
						<a href="vacation.php?id=<?php echo $t['Tour']['id']; ?>" class="link-seemore">
							See more &nbsp;<span class="seemore">&plus;</span>
						</a>
					</div>					
				</div>
			<?php endforeach; ?>

			<div class="clearfix"></div>

			<?php
			echo $this->Paginator->numbers();

// Shows the next and previous links
			echo $this->Paginator->prev(
					'« Previous', null, null, array('class' => 'disabled')
			);
			echo $this->Paginator->next(
					'Next »', null, null, array('class' => 'disabled')
			);

// prints X of Y, where X is current page and Y is number of pages
			echo $this->Paginator->counter();
			?>

		<?php endif; ?>

	</div>
</div>

<div class="div-space2"></div>