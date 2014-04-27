<?php
include_once './core/DataContext.php';

$db = new DataContext();
$tour = $db->getTourById($_GET['id']);
$destination = $db->getDestinationById($tour->destinationId);

$title_for_layout = "Bon Voyage | $tour->name: $tour->details";
$active_tab = '';
?>

<html>
	<?php include './layout/documents.php'; ?>

	<body>

		<?php include './layout/logo.php'; ?>

		<?php include './layout/navigation.php'; ?>

		<div class="div-content col-xs-12">
			<div class="container">

				<h1 class="page-title" style="margin-bottom: 25px">BOOK A TOUR</h1>

				<div class="vacation-left-col pull-left">
					<div class="white-content">
						<img src="<?php echo $tour->image; ?>" />
						<div class="wrap">
							<h2><?php echo $tour->name; ?></h2>
							<p class="details"><?php echo $tour->details; ?></p>
							<strong><?php echo $tour->shortDescription; ?></strong>
							<div class="div-book">
								<span class="pull-left">Book now for only <strong>&dollar;<?php echo $tour->price; ?></strong> each person</span>
								<button class="btn btn-success pull-right">Add to Cart</button>
								<div class="clearfix"></div>
							</div>
							<?php echo $tour->description; ?>
							<a href="vacations.php?anchor=anchor-main&destination=<?php echo $destination->id; ?>">
								&ll; Look out for more <?php echo $destination->name; ?> tours
							</a>
						</div>
					</div>
				</div>

				<div class="vacation-right-col pull-right">
					<div class="intro">
						<p>Bon Voyage offers travel information on a wide range of destinations.</p>
						<p>There might be some other tours that you interested in. </p>
					</div>
					
					<h2>$649</h2>
					<div class="white-content">
						<p>Romantic Provence Getaway</p>
						<a href="#" class="seemore">&plus;</a>
						<div class="border-bottom"></div>
					</div>

					<h2>$449</h2>
					<div class="white-content">
						<p>8 Nights Alaska Cruise All Inclusive</p>
						<a href="#" class="seemore">&plus;</a>
						<div class="border-bottom"></div>
					</div>

					<h2>$649</h2>
					<div class="white-content">
						<p>4 Nights All Inclusive Cancun Resort & Spa</p>
						<a href="#" class="seemore">&plus;</a>
						<div class="border-bottom"></div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="div-space" ></div>

		<?php include './layout/footer.php'; ?>

	</body>
</html>
