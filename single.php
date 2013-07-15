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
						
			$feed				 = new Tiles($wpdb, "blog", $filter);
			//$staticMenschenFeed  = new Tiles($wpdb); //empty
			
			//$staticMenschenFeed->addFeed(313, "intro");
			//$staticMenschenFeed->addFeed(313, "contact");
			//$staticMenschenFeed->addFeed(313, "linkedin");
		?>
	</head>
	
	<body>

		<header>
			<div class="container containerNavi">	
				<?php include 'html/buildHeader.php'; ?>	
			</div>
		</header>

		<div class="container containerIsotope"> 
			<div id="isotope" class="blogMain">
			
				<div class="item postTileSingle">
					<div class="main">
						<div class="postContent">
							<?php
								if (have_posts()) :
								   while (have_posts()) :
								      the_post();
								      echo("<h1>".get_the_title()."</h1>");
								      the_content();
								   endwhile;
								endif;
							?>		
						</div>

					</div>
					<div class="shadow">
					</div>	
				</div>
			</div>
			<div id="isotope" class="blogNavi">
					<?php dynamic_sidebar ('sidebar-1');?>

			</div>
		</div>
		
		<?php include 'footer.php'; ?>
		<foter>
			<div class="container">	
				foryouandyourcustomers gibt's in Amsterdam, Genf, München, Wien und Zürich	
			</div>
		</footer>
		
	</body>	
</html>