<div class="footer">
	<div class="row-1" >
		<div class="container">
			<h2>BOOK YOUR VACATION NOW</h2>
			<?php
			if (basename($_SERVER['PHP_SELF']) == 'vacations.php') {
				$go_link = '#anchor-main';
			} else {
				$go_link = 'vacations.php?anchor=anchor-main';
			}
			?>
			<a href="<?php echo $go_link; ?>" class="btn-custom pull-right">GO</a>
		</div>
	</div>

	<div class="row-2" >
		<div class="container">
			<div class="col-xs-6">
				<h3>About us</h3>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.
				</p>
				<br />
				<p>Copyright &copy; 2014. Bon Voyage Coporation.</p>
			</div>
			<div class="col-xs-3">
				<h3>Contacts</h3>
				<ul>
					<li>Tel: 123-456-7890</li>
					<li>Fax: 123-456-7890</li>
					<li>info@mysite.com</li>
					<br />
					<li>2601 ABC St. San Francisco, CA 64789</li>
				</ul>
			</div>
			<div class="col-xs-3">
				<h3>Partners</h3>
				<ul>
					<li>Google</li>
					<li>Facebook</li>
					<li>Apple</li>
					<li>Microsoft</li>
				</ul>
			</div>
		</div>
	</div>
</div>

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
		$('body').fadeIn({ duration: duration, queue: false });	
		<?php if (isset($_GET['anchor'])) : ?>
			var anchor = '#<?php echo $_GET['anchor']; ?>';
			root.animate({
				scrollTop: $(anchor).offset().top
			}, { duration: duration, queue: false });
		<?php endif; ?>
	});
</script>