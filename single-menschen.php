<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<html>
	<head>
		<?php get_header(); ?>
		<?php wp_head(); ?>
		<link href="wp-content/themes/fyyc/page.css" rel="stylesheet" media="screen">

		
		<?php			
			include("wp-content/themes/fyyc/php/Tiles.php");	
			include("wp-content/themes/fyyc/plugins/multiplePostThumbnails/multi-post-thumbnails.php");

			$feed = new Tiles($wpdb, "menschen");
			
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post(); 
					$the_content = get_the_content();
					$the_title = get_the_title();
				} 
			}
			
			$staticMenschenFeed = new Tiles($wpdb);	
			$staticMenschenFeed->addFeed(313, "intro", false, $the_content);
			$staticMenschenFeed->addFeed(313, "conact", $the_title);
			$staticMenschenFeed->addFeed(313, "linkedin");


			
			
			$staticMenschenFeed->printTest();
			
			print_r($feed->getTiles());
			
			the_content();
			
			//print_r($feed->getTiles());
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


		<div class="container containerDesktop test">
			<div id="isotope">
				<?php
				
					foreach ($staticMenschenFeed->getTiles() as $index => $value) {
						$staticMenschenFeed->printTile($index, false);
					}
					
					foreach ($feed->getTiles() as $index => $value) {
						$feed->printTile($index, false);
					}
					$i=0;
					
					while($i<100){
						$feed->generateCrap();
						$i++;
					}
					
				?>
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
		
		
		$(document).ready(function() {
		        // $('#slide').slideDown("slow");
		}); 
		$("#heroSlideButton").click(function () {
			if ($("#heroSlider").is(":hidden")) {
				$("#heroSlider").slideDown("slow");
				} else {
				$("#heroSlider").slideUp("slow");
				}		
	    });
	    
	    $(document).ready(function() {
		        // $('#slide').slideDown("slow");
		}); 
		$("#naviSlideButtonMenschen").click(function () {
			if ($("#naviSliderMenschen").is(":hidden")) {
				$("#naviSliderMenschen").slideDown("slow");
				} else {
				$("#naviSliderMenschen").slideUp("slow");
				}		
	    });

	</script>
</html>