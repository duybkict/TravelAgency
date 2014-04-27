<?php
include_once './core/DataContext.php';

$db = new DataContext();
$options = array('page' => $_GET['page']);
if (isset($_GET['destination'])) {
	$options['destination_id'] = $_GET['destination'];
	$vacation = $db->getDestinationById($_GET['destination']);
}
$tours = $db->getTours($options);

$title_for_layout = 'Bon Voyage |  ' . (isset($vacation) ? "$vacation->name Tours" : 'Vacations');
$active_tab = 'vacations';
?>

<html>
	<?php include './layout/documents.php'; ?>

	<body>

		<?php include './layout/logo.php'; ?>

		<?php include './layout/navigation.php'; ?>
		
		<div class="div-content col-xs-12">
			<div class="container">

				<h1 class="page-title">VACATIONS <?php if(isset($vacation)) echo " - $vacation->name TOURS";?></h1>

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
				
				<?php foreach ($tours as $k => $t) : 
					$description = (strlen($t->shortDescription) > 203) ? substr($t->shortDescription, 0, 200) . '...' : $t->shortDescription;?>
					<div class="vacation-item <?php if (($k + 1) % 4 == 0 ) echo 'last';?>">
						<img src="<?php echo $t->thumbnail; ?>" />
						<div class="wrap">
							<h2>$<?php echo $t->price; ?></h2>
							<strong><?php echo $t->name; ?>:</strong>
							<span><?php echo $t->details; ?></span>
							<p><?php echo $description; ?></p>
							<a href="vacation.php" class="link-seemore">
								See more &nbsp;<span class="seemore">&plus;</span>
							</a>
						</div>					
					</div>
				<?php endforeach; ?>
				
				<div class="clearfix"></div>
				
				<?php echo getPagination($_GET['page'], $db->getCountPageTours($options), array('anchor' => 'anchor-main')); ?>
				
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="div-space2"></div>

		<?php include './layout/footer.php'; ?>

	</body>
</html>
