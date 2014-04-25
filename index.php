<?php
$title_for_layout = 'Bon Voyage | Travel Agency';
$active_tab = 'home';
?>

<html>
	<?php include './layout/documents.php'; ?>

	<body>

		<?php include './layout/logo.php'; ?>

		<?php include './layout/navigation.php'; ?>

		<div class="div-content col-xs-12">
			<div class="container">

				<div class="home-left-col text-center pull-left">
					<div class="social-icons">
						<a href="#"><img src="img/facebook.png" /></a>
						<a href="#"><img src="img/twitter.png" /></a>
						<a href="#"><img src="img/googleplus.png" /></a>
						<a href="#"><img src="img/pinterest.png" /></a>
					</div>
					<img src="img/binoculars.png" style="margin-bottom: 18px" />
					<a href="vacations.php?anchor=anchor-main" class="banner">SEARCH</a>
					<span>For A Holiday</span>
					<a href="aboutus.php" class="btn-custom" style="width: 100%">WELCOME TO OUR WORLD</a>
				</div>

				<div class="home-right-col pull-right">
					<p>SEE HOW MUCH <br/>YOU CAN SAVE WITH THESE LAST MINUTE BON VOYAGE<br/> RATES.</p>
					<a href="#anchor-main" class="pull-right" style="margin-top: 5px;">See Details &nbsp;&nbsp;<span class="seemore">&plus;</span></a>
				</div>

				<div class="clearfix"></div>

				<div class="div-space"></div>
				<a id="anchor-main" ></a>

				<div class="home-left-col-1 pull-left">
					<h2>Handpicked Offers</h2>
					<img class="h2-icon" src="img/clock.png" />
					<div class="white-content">
						<span class="list-details">
							Romantic Paris <span class="color-white">---------------</span> $449
						</span>
						<span class="list-details">
							Sri Lanka <span class="color-white">--------------------</span> $699
						</span>
						<span class="list-details">
							Tuscany to Provence <span class="color-white">----------</span> $845
						</span>
						<span class="list-details">
							Florida Getaway <span class="color-white">--------------</span> $199
						</span>
						<span class="list-details">
							NYC Escape <span class="color-white">------------------</span> $899
						</span>
						<a href="vacations.php" class="link-seemore">
							See more &nbsp;<span class="seemore">&plus;</span>
						</a>
					</div>

					<h2>Summer Destinations</h2>
					<img class="h2-icon" src="img/plane.png" />
					<div class="white-content" style="margin-bottom: 3px;">
						<span class="list-details">
							Barcelona <span class="color-white">-------------------</span> $999​
						</span>
						<span class="list-details">
							Anchorage <span class="color-white">------------------</span> $199
						</span>
						<span class="list-details">
							Vancouver <span class="color-white">------------------</span> $159
						</span>
						<span class="list-details">
							Maui <span class="color-white">-----------------------</span> $649
						</span>
						<span class="list-details">
							Cape Cod <span class="color-white">--------------------</span> $599
						</span>
						<a href="destinations.php" class="link-seemore">
							See more &nbsp;<span class="seemore">&plus;</span>
						</a>
					</div>
				</div>

				<div class="home-right-col-1 pull-right">
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
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="div-space"></div>

		<?php include './layout/footer.php'; ?>

	</body>
</html>
