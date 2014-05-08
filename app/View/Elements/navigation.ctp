<?php
$controller = $this->request->params['controller'];
$action = $this->request->params['action'];

$active1 = $active2 = $active3 = $active4 = $active5 = '';
switch ($controller) {
	case 'pages':
		switch ($action) {
			case 'index':
				$active1 = 'active';
				break;
			case 'display':
				if ($page == 'aboutus') $active4 = 'active';
				if ($page == 'checkout') $active5 = 'active';
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
			<li><?php echo $this->Html->link('Home', '/', array('class' => $active1)); ?></li>
			<li><?php echo $this->Html->link('Destinations', array('controller' => 'destinations', 'action' => 'index'), array('class' => $active2)); ?></li>
			<li><?php echo $this->Html->link('Vacations', array('controller' => 'tours', 'action' => 'index'), array('class' => $active3)); ?></li>
			<li><?php echo $this->Html->link('About Us', '/pages/aboutus', array('class' => $active4)); ?></li>
			<li><?php echo $this->Html->link('Checkout (0)', '/pages/checkout', array('class' => $active5)); ?></li>
		</ul>
	</div>
</div>