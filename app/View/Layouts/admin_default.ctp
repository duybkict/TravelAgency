<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			<?php echo $title_for_layout; ?>
		</title>
		<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('blueimp-gallery.min');
		echo $this->Html->css('font_arial_narrow');
		echo $this->Html->css('admin_style');

		echo $this->Html->script('jquery.min');		
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('bootstrap.file-input.min');
		echo $this->Html->script('blueimp-gallery.min');
		echo $this->Html->script('jquery.blueimp-gallery.min');
		echo $this->Html->script('/TinyMCE/js/tiny_mce/tiny_mce.js', array('inline' => false));

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php echo $this->element('nav'); ?>

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
