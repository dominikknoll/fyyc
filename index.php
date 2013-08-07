<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">


<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="<?php echo get_stylesheet_directory_uri()?>/blog.css" rel="stylesheet" media="screen">

		
		<?php			
		
			$category_name = get_query_var('cat');
			
			$filter = array(
			    "filter" => "category",
			    0 		 => $category_name,
			);
			
			//print_r($filter);
						
			$feed				 = new Tiles($wpdb, false, "blog", $filter);
			//$staticMenschenFeed  = new Tiles($wpdb); //empty
			
			//$staticMenschenFeed->addFeed(313, "intro");
			//$staticMenschenFeed->addFeed(313, "contact");
			//$staticMenschenFeed->addFeed(313, "linkedin");
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
					<?php dynamic_sidebar ('sidebar-1');?>

			</div>
		</div>
		
		<?php include 'footer.php'; ?>
		
	</body>	
</html>