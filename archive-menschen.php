<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="wp-content/themes/fyyc/page.css" rel="stylesheet" media="screen">

		
		<?php			
			$feed				 = new Tiles($wpdb, "menschen");
			$staticMenschenFeed  = new Tiles($wpdb); //empty
			
			$staticMenschenFeed->addFeed(313, "intro");
			$staticMenschenFeed->addFeed(313, "contact");
			//$staticMenschenFeed->addFeed(313, "linkedin");
		?>
	</head>
	
	<body>
		<header>
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
			</div>
			<div class="imageContainer">
				<img src="wp-content/themes/fyyc/img/img.jpg">
			</div>
		</header>

		<div class="container containerIsotope test"> 
			<div id="isotope">
				<?php
				
					foreach ($staticMenschenFeed->getTiles() as $index => $value) {
						$staticMenschenFeed->printTile($index, false);
					}
					
					foreach ($feed->getTiles() as $index => $value) {
						$feed->printTile($index, false);
					}
				?>
			</div>
		</div>
		<?php include 'footer.php'; ?>
		<foter>
			<div class="container">	
				foryouandyourcustomers gibt's in Amsterdam, Genf, München, Wien und Zürich	
			</div>
		</footer>
		
	</body>	
</html>