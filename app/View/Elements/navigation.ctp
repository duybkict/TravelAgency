<?php
$controller = $this->request->params['controller'];
$action = $this->request->params['action'];

$active1 = $active2 = $active3 = $active4 = '';
switch ($controller) {
	case 'pages':
		switch ($action) {
			case 'index':
				$active1 = 'active';
				break;
			case 'display':
				if ($page == 'aboutus') $active4 = 'active';
				break;
		}
		break;
	case 'destinations':
		$active2 = 'active';
		break;
	case 'tours':
		$active3 = 'active';
		break;
}
?>

<div class="div-navigation col-xs-12">
	<div class="container">
		<ul>
			<li><?php echo $this->Html->link('Home', array('controller' => 'pages'), array('class' => $active1)); ?></li>
			<li><?php echo $this->Html->link('Destinations', array('controller' => 'destinations'), array('class' => $active2)); ?></li>
			<li><?php echo $this->Html->link('Vacations', array('controller' => 'tours'), array('class' => $active3)); ?></li>
			<li><?php echo $this->Html->link('About Us', '/pages/aboutus', array('class' => $active4)); ?></li>
			<li>
				<a href="checkout.php" class="" >
					Checkout (0)
				</a>
			</li>
		</ul>
	</div>
</div>