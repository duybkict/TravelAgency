<div class="col-xs-6 col-xs-offset-3">
	<div class="panel panel-default">
		<div class="panel-heading">
			Login
		</div>
		<div class="panel-body">
			<?php
			echo $this->Session->flash();
			echo $this->Form->create('User', array(
				'class' => 'form-horizontal',
				'inputDefaults' => array(
					'label' => false)
			));
			?>
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-xs-3 control-label">Email</label>
					<div class="col-xs-9">
						<?php echo $this->Form->input('User.username', array('class' => 'form-control')); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-xs-3 control-label">Password</label>
					<div class="col-xs-9">
						<?php echo $this->Form->password('User.password', array('class' => 'form-control')); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<button type="submit" class="btn btn-primary pull-right">Login</button>

					</div>
				</div>
				<?php echo $this->Form->create(); ?>
		</div>
	</div>
</div>