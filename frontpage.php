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


			$feed = new Tiles($wpdb, "frontpage");
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