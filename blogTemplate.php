<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">


<?php
   /*
   Template Name: blog
   */
?>
   

<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="<?php echo get_stylesheet_directory_uri()?>/blog.css" rel="stylesheet" media="screen">

		
		<?php			
		
			$category_name = get_query_var('cat');
			echo($category_name);
			
			$test = get_query_var(true);
			print_r($test);
			
			$filter = array(
			    "filter" => "category",
			    0 		 => $category_name,
			);
			
			
			$args = array();
			$args['siteType'] = "blog";
			$args['selector'] = $filter;
			
	
			$feed				 = new Tiles($wpdb, $args);
			
			
			
			
			$args = array();

			$args['hierarchical'] = "true";
			$args['taxonomy'] = "leistungen";

			print_r($args);

			$widgets = new Widgets($args);
			print_r($widgets->getFeed());
			
			

		?>
	</head>
	
	<body>

		<header>
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
				<?php include 'html/buildBlogHero.php'; ?>	

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
			
				<div class="item widget">
					<div class="main">
						<h3 class="item widget-title">Kategorien</h3>
							<?php $widgets->printAll(); ?>
					</div>
				</div>
				
					<div class="item widget">
					<div class="main">
						<h3 class="item widget-title">Tags</h3>
	
					</div>
				</div>
					<?php dynamic_sidebar ('sidebar-1');?>
					

			</div>
		</div>
		
		<?php include 'footer.php'; ?>
		
	</body>	
</html>