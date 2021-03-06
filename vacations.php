<?php
include_once './core/DataContext.php';

$db = new DataContext();
$options = array('page' => $_GET['page']);
if (isset($_GET['destination'])) {
	$options['destination_id'] = $_GET['destination'];
	$destination = $db->getDestinationById($_GET['destination']);
}
$tours = $db->getTours($options);

$title_for_layout = 'Bon Voyage |  ' . (isset($destination) ? "$destination->name Tours" : 'Vacations');
$active_tab = 'vacations';
?>

<html>
	<?php include './layout/documents.php'; ?>

	<body>

		<?php include './layout/logo.php'; ?>

		<?php include './layout/navigation.php'; ?>
		
		<div class="div-content col-xs-12">
			<div class="container">

				<h1 class="page-title">VACATIONS <?php if(isset($destination)) echo " - $destination->name TOURS";?></h1>

				<div class="vacations-left-col text-center pull-left">
					<img src="img/sandals.png" style="margin: 38px auto 15px;"/>
					<br/>
					<span>EXPLORE.<br/>DREAM.<br/>DISCOVER.</span>
				</div>

				<div class="vacations-right-col text-center pull-right">
					<img src="img/slide1.jpg" />					
				</div>

				<div class="clearfix"></div>

				<div class="div-space2"><a id="anchor-main" ></a> </div>
				
				<?php if (empty($tours)) : ?>
					<div class="vacation-item-empty">
						<h2>No <?php if(isset($destination)) echo "$destination->name";?> tours available!</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						<p>Curabitur pretium tincidunt lacus. Nulla gravida orci a odio. Nullam varius, turpis et commodo pharetra, est eros bibendum elit, nec luctus magna felis sollicitudin mauris. Integer in mauris eu nibh euismod gravida. Duis ac tellus et risus vulputate vehicula. Donec lobortis risus a elit. Etiam tempor. Ut ullamcorper, ligula eu tempor congue, eros est euismod turpis, id tincidunt sapien risus a quam. Maecenas fermentum consequat mi. Donec fermentum. Pellentesque malesuada nulla a mi. Duis sapien sem, aliquet nec, commodo eget, consequat quis, neque. Aliquam faucibus, elit ut dictum aliquet, felis nisl adipiscing sapien, sed malesuada diam lacus eget erat. Cras mollis scelerisque nunc. Nullam arcu. Aliquam consequat. Curabitur augue lorem, dapibus quis, laoreet et, pretium ac, nisi. Aenean magna nisl, mollis quis, molestie eu, feugiat in, orci. In hac habitasse platea dictumst.</p>
						<a href="vacations.php?anchor=anchor-main">&ll; Go explore another options</a>
					</div>
				<?php else: ?>
				
				<?php foreach ($tours as $k => $t) : 
					$description = (strlen($t->shortDescription) > 203) ? substr($t->shortDescription, 0, 200) . '...' : $t->shortDescription;?>
					<div class="vacation-item <?php if (($k + 1) % 4 == 0 ) echo 'last';?>">
						<img src="<?php echo $t->thumbnail; ?>" />
						<div class="wrap">
							<h2>$<?php echo $t->price; ?></h2>
							<strong><?php echo $t->name; ?>:</strong>
							<span><?php echo $t->details; ?></span>
							<p><?php echo $description; ?></p>
							<a href="vacation.php?id=<?php echo $t->id; ?>" class="link-seemore">
								See more &nbsp;<span class="seemore">&plus;</span>
							</a>
						</div>					
					</div>
				<?php endforeach; ?>
				
				<div class="clearfix"></div>
				
				<?php echo getPagination($_GET['page'], $db->getCountPageTours($options), array('anchor' => 'anchor-main')); ?>
				
				<?php endif; ?>
				
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="div-space2"></div>

		<?php include './layout/footer.php'; ?>

	</body>
</html>
