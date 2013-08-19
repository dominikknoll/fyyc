<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">



<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="<?php echo get_stylesheet_directory_uri()?>/css/blog.css" rel="stylesheet" media="screen">


		<?php			
		

			if((get_query_var('cat')) 	 != null) $category_id = get_query_var('cat');
			
			if((get_query_var('tag_id')) != null){
				
				$category_id = get_query_var('tag_id');

				$term = get_term( $category_id, "post_tag");
	
				//print_r($term);
				
				$category_id = $term->term_taxonomy_id;
			
			}			
			//$args = array();
			//$args['siteType'] = "blog";
			//$args['selector'] = $filter;
			
	
			//$feed= new Tiles($wpdb, $args);
/*
			
			print_r($widgets->getFeed());
			*/
			
			$args = array();
			$args['hierarchical'] = "true";
			$args['taxonomy'] = "post_tag";
			$defaultTags = new Widgets($args);
			
			$args = array();
			$args['hierarchical'] = "true";
			$args['taxonomy'] = "category";
			$defaultCat = new Widgets($args);
			
			
			
			$filter = array();
			$filter['id'] = $category_id;
			$args = array();
			$args['siteType'] = "blog";
			$args['selector'] = $filter;
			
			$feed= new Tiles($wpdb, $args);
			

		?>
	</head>
	
	<body>

		<header>
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
				
				<?php buildHero("Mit foryouandyourcustomers entwickeln wir uns und für Sie und Ihre Kunden das Multichannel-Business"); ?>

				
					

			</div>
		</header>

		<div class="container containerIsotope"> 
			<div id="isotope" class="blogMain">
				<?php
				
					//foreach ($staticMenschenFeed->getTiles() as $index => $value) {
					//	$staticMenschenFeed->printTile($index, false);
					//}
					
					foreach ($feed->getTiles() as $index => $value) {
						$feed->printTile($index, false);
					}
				?>
			</div>
			<div id="isotope" class="blogNavi">
			
				<?php $defaultCat->getTaxonomy("cat");?>
				<?php $defaultTags->getTaxonomy("tag");?>
				
				<?php dynamic_sidebar ('sidebar-1');?>
			</div>
		</div>
		<script>
		
			$("#showMoreTags").click(function () {
				if ($("#hiddenTags").is(":hidden")) {
					$("#hiddenTags").slideDown("slow");
					$("#showMoreTags").html("Weniger Tags anzeigen");
		
					;		
					} else {
					$("#hiddenTags").slideUp("slow");
					$("#showMoreTags").html("Alle Tags anzeigen");
					}		
		    });

		</script>
		
		
		
		<?php include 'footer.php'; ?>
		
	</body>	
</html>