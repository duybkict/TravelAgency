<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo $title_for_layout; ?></title>

		<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap-glyphicon.min');
		echo $this->Html->css('font-cookie');
		echo $this->Html->css('font-kreon');
		echo $this->Html->css('font-lobster');
		echo $this->Html->css('font-myriadpro');
		echo $this->Html->css('font-spinnaker');
		echo $this->Html->css('admin_style');

		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php 
		if ($this->request->controller != 'users' || $this->request->action != 'admin_login')
			echo $this->element('admin_navigation'); 
		
		?>

		<div class="container">
			<div class="row">
				<?php echo $this->fetch('content'); ?>								
			</div>
		</div>
		
		<?php
		if (Configure::read('debug') == 2) {
			echo $this->element('sql_dump');
		}
		?>
	</body>
</html>
