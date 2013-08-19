<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<html>
	<head>
		<?php get_header(); wp_head(); ?>


				<link href="<?php echo get_stylesheet_directory_uri()?>/css/page.css" rel="stylesheet" media="screen">
				<link href="<?php echo get_stylesheet_directory_uri()?>/css/leistungen.css" rel="stylesheet" media="screen">

				


		
		<?php			
			$feed	= new Leistungen($wpdb, ICL_LANGUAGE_CODE);
		?>
	</head>
	<body>
		<header> 
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
				<?php buildHero("Wir bieten folgende Leistungen für Sie uns Ihre Kunden an"); ?>


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
		

		
		<?php include 'footer.php'; ?>
		<script>
			var $container = $('#isotope');
			// initialize isotope
			$container.isotope({
			  // options...
			});
			
			// filter items when filter link is clicked
			$('#filters a').click(function(){
			  var selector = $(this).attr('data-filter');
			  $container.isotope({ filter: selector });
			  return false;
			});
		</script>
	</body>	

</html>