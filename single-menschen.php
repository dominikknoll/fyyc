<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<html>
	<head>
		<?php get_header(); ?>
		
		<?php wp_head(); ?>
		
		<?php
			include("wp-content/themes/foryouandyourcustomers/php/generateTiles.php");	
					
			include("wp-content/themes/foryouandyourcustomers/php/getRankedDate.php");		
			$feed = $wpdb->get_results($query);
			
			
			//print_r($feed);	
		?>
		
	</head>
	
	<body>
	
		<div class="container">
			<?php include 'html/buildHeader.php'; ?>	
		</div>
		<div class="container">
			<?php include 'html/buildHero.php'; ?>	
		</div>
		
		<div class="content_color">
			<div class="container">

				<div id="isotope">
					<div class="item">2</div>
				</div>

			</div>
		</div>
		
		<?php //include 'buildFooter.php'; ?>
	</body>
	
	<script>

		var jQuerycontainer = jQuery('#isotope');
		jQuerycontainer.imagesLoaded( function(){
		  jQuerycontainer.isotope({
		  itemSelector: '.item',
		  layoutMode : 'masonry'
		   });	
		});

		</script>
</html>