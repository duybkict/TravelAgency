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
		echo $this->Html->css('style');

		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		?>
	</head>

	<body>
		<?php echo $this->element('logo'); ?>

		<?php echo $this->element('navigation'); ?>

		<?php echo $this->fetch('content'); ?>		

		<?php echo $this->element('footer'); ?>

		<?php
//		if (Configure::read('debug') == 2) {
//			echo $this->element('sql_dump');
//		}
		?>

		<script type="text/javascript">
			var duration = 600;
			var root = $('html, body');
			$('a').click(function() {
				root.animate({
					scrollTop: $($.attr(this, 'href')).offset().top
				}, duration);
				return false;
			});

			$(document).ready(function() {
				$('body').fadeIn({duration: duration, queue: false});
				<?php if (isset($this->request->named['anchor'])) : ?>
					var anchor = '#<?php echo $this->request->named['anchor']; ?>';
					root.animate({
						scrollTop: $(anchor).offset().top
					}, {duration: duration, queue: false});
				<?php endif; ?>
			});
		</script>
	</body>
</html>
