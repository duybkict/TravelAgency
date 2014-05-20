<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<?php echo $this->Html->link('Administrator', '/admin/index', array('class' => 'navbar-brand')); ?>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link('Destinations', array('controller' => 'destinations', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Tours', array('controller' => 'tours', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Orders', array('controller' => 'orders', 'action' => 'index')); ?></li>
				<li><?php echo $this->Html->link('Users', array('controller' => 'users', 'action' => 'index')); ?></li>
			</ul>
<!--			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>-->
			<ul class="nav navbar-nav navbar-right">
				<li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout')); ?></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
