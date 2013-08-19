<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="<?php echo get_stylesheet_directory_uri()?>/css/page.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_stylesheet_directory_uri()?>/css/menschen.css" rel="stylesheet" media="screen">
		
		<?php			
			$feed	= new Menschen($wpdb, ICL_LANGUAGE_CODE);
			
			function print_Filter($feed){
					
					$args = array(
						  'taxonomy'     => 'leistungen',
						  'orderby'      => 'name',
						  'pad_counts'   => 0,
						  'hierarchical' => 1,
						  'title_li'     => ''
						);
						
						$leistungenTaxonomy = get_categories( $args );
						
						function cmp($a, $b)
						{
						    return strcmp($b->count, $a->count);
						}
						
						usort($leistungenTaxonomy, "cmp");
					
						
						//echo('<li><a href="*" data-filter="*">show all</a></li>');
						//print_r($leistungenTaxonomy);
						
						
						
						
						$countAbsoluteMenschen = $feed->countFeedData();
						
						$countAbsolute =  count($leistungenTaxonomy);
						
						$postsPerColum = (($countAbsolute)-($countAbsolute % 3))/3;
						
						$firstrow  = $countAbsolute -2*$postsPerColum;						
						$secondrow = $countAbsolute - $firstrow -$postsPerColum;
						$thirdrow = $postsPerColum;
						
						$skiprow = array();
						
						$skiprow[$firstrow]=true;
						$skiprow[$firstrow+$secondrow]=true;
						$skiprow[$firstrow+$secondrow+$thirdrow]=true;
						
						
						if($leistungenTaxonomy != null){
						$i = 0;
						echo("<div class='col'>");
							foreach ($leistungenTaxonomy as $value) {
										$slug  = $value->slug;
										$count = $value->count;
										$name = $value->name;
										
										$percent = ($count/$countAbsoluteMenschen)*93.7;
										
										
										
										
										echo('<li><div class="wrapper" style="width:'.$percent.'%"><a href="#" data-filter=".'.$slug.'">'.$name.' ('.$count.')</a></div></li>');
										
										$i++;
										
										if($skiprow[$i]) echo("</div><div class='col'>");
										
									}		
						echo("</div>");
						}				
					
				}
			
			function countElements(){
					
					$args = array(
						  'taxonomy'     => 'leistungen',
						  'orderby'      => 'name',
						  'pad_counts'   => 0,
						  'hierarchical' => 1,
						  'title_li'     => ''
						);
						$leistungenTaxonomy = get_categories( $args );
						$countAbsolute =  count($leistungenTaxonomy);
						return $countAbsolute;
				}
				
			function getData($name){
					
					$args = array(
						  'taxonomy'     => 'leistungen',
						  'orderby'      => 'name',
						  'pad_counts'   => 0,
						  'hierarchical' => 1,
						  'title_li'     => ''
						);
						$leistungenTaxonomy = get_categories( $args );
						
						$var = array();
						
						foreach ($leistungenTaxonomy as $value) {

							
							if($value->slug == $name){
							
								$var["slug"]  = $value->slug;
								$var["count"]  = $value->count;
								$var["name"]  = $value->name;	
								
								return $var;
							}
						}
						
						return false;
				}

		?>
	</head>
	<body>
		<header> 
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
				
				<div class="hero-unit hyphe">
				
				<?
					$data = getData("multichannel-vermaktung");
					
					echo('
						<div class="titeltxt">
						Bei <span style="color:#73be46 !important">foryouandyourcustomers</span> arbeiten <span style="color:black !important">'.$data["count"].' Menschen</span> 
						die Erfahrung in <span style="color:black !important">'.$data["name"].'</span> haben. Lernen Sie mehr Mitarbeiter kennen.
						</div>
					');
					
				
				?>
				
					
				
					
					<button class="" id="heroSlideButton"> Menschen filtern<span>&nbsp;</span> </button>	
					<div style="display:none; " id="heroSlider" > 						
						<ul id="filters">
							<? print_Filter($feed); ?>
						
						</ul>								
					</div>
				</div>
				

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