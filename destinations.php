<?php
include_once './core/DataContext.php';

$title_for_layout = 'Bon Voyage | Destinations';
$active_tab = 'destinations';

$db = new DataContext();
$options = array('page' => $_GET['page']);
$destinations = $db->getDestinations($options);
?>

<html>
	<?php include './layout/documents.php'; ?>

	<body>

		<?php include './layout/logo.php'; ?>

		<?php include './layout/navigation.php'; ?>

		<div class="div-content col-xs-12">
			<div class="container">

				<h1 class="page-title">DESTINATIONS</h1>

				<div class="destinations-left-col pull-left">
					<img src="img/slide1.jpg" />
				</div>

				<div class="destinations-right-col text-center pull-right">
					<img src="img/briefcase.png" style="margin: 38px auto 5px;"/>
					<a href="vacations.php?anchor=anchor-main" class="banner">START</a>
					<span>The Adventure</span>
				</div>

				<div class="clearfix"></div>

				<div class="div-space2"><a id="anchor-main" ></a></div>

				<div class="destinations-left-col-1 pull-left">
					<h2>Summer Destinations</h2>
					<img class="h2-icon" src="img/plane.png" />
					
					<?php foreach ($destinations as $d) : 
					$description = (strlen($d->description) > 133) ? substr($d->description, 0, 130) . '...' : $d->description;?>
					<div class="destination-item">
						<div class="wrap pull-left">
							<h3><?php echo $d->name; ?></h3>
							<p><?php echo $description; ?></p>
						</div>
						<a href="vacations.php?destination=<?php echo $d->id; ?>&anchor=anchor-main" >
							<img src="<?php echo $d->image; ?>" />
						</a>						
						<a href="vacations.php?destination=<?php echo $d->id; ?>&anchor=anchor-main" class="seemore">&plus;</a>
					</div>
					<?php endforeach; ?>
					
					<?php echo getPagination($_GET['page'], $db->getCountPageTours($options), array('anchor' => 'anchor-main')); ?>

				</div>

				<div class="destinations-right-col-1 text-center pull-right">
					<p class="p-intro">FIND SUGGESTED HOTELS, DAY TRIPS & ADVENTURE TIPS</p>

					<div class="div-intro">
						Bon Voyage offers travel information on a wide range of destinations. Learn about your destination today and contact us for more information.
					</div>
					
					<h2>Need Help?</h2>
					<img class="h2-icon" src="img/help.png" />
					
					<div class="white-content">
						<p>Booking a major trip is exciting, but it can also be a bit overwhelming. </p>
						<p>We understand. That's why we have live Travel Experts here to take care of your every need, making your trip stress-free & amazing.</p>
						<strong style="margin-top: 10px;">Call Us Today </strong>
						<strong>1-800-000-0000</strong>
						<div class="border-bottom"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="div-space2"></div>

		<?php include './layout/footer.php'; ?>

	</body>
</html>
