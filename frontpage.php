<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">
<?php
   /*
   Template Name: frontpage
   */
?>
   
<html>
	<head>
		<?php get_header(); ?>
		<?php wp_head(); ?>
		<link href="<?php echo get_stylesheet_directory_uri()?>/frontpage.css" rel="stylesheet" media="screen">

		<?php			


			$feed = new Tiles($wpdb, false, "frontpage");

		?>
	
	</head>
	
	<body>
		<header>
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
				<?php include 'html/buildHero.php'; ?>	
			</div>
		</header>
		
		<div class="container containerIsotope">
			<div id="isotope">
				<?php
					foreach ($feed->getTiles() as $index => $value) {
						$feed->printTile($index, false);
					}
				?>
			</div>
		</div>

		
		<?php //include 'buildFooter.php'; ?>
						    

				<?php include 'footer.php'; ?>


	</body>

</html>

