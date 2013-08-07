<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="wp-content/themes/fyyc/page.css" rel="stylesheet" media="screen">

		
		<?php			
			$feed	= new Menschen($wpdb, ICL_LANGUAGE_CODE);
			
			//print_r($feed);

		?>
	</head>
	<body>
		<header> 
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
				<?php include 'html/buildMenschenArchiv.php'; ?>	
				
				
				<?php 

				$args = array(
				  'taxonomy'     => 'leistungen',
				  'orderby'      => 'name',
				  'show_count'   => 0,
				  'pad_counts'   => 0,
				  'hierarchical' => 1,
				  'title_li'     => ''
				);
				
				$leistungenTaxonomy = get_categories( $args );
				
				?>

								
				<ul id="filters">
				
				
				<?php
					echo('<li><a href="*" data-filter="*">show all</a></li>');

					if($leistungenTaxonomy != null){
						foreach ($leistungenTaxonomy as $value) {
									$leistungenTaxonomyString = $value->slug;
									
									echo('<li><a href="#" data-filter=".'.$leistungenTaxonomyString.'">'.$leistungenTaxonomyString.'</a></li>');
								}		
					}				
				?>
				
				</ul>								
				
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