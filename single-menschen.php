<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="wp-content/themes/fyyc/page.css" rel="stylesheet" media="screen">

		
		<?php	
			$postid = get_the_ID();				
			$title = get_the_title();		
					
			$post_thumbnail_id  = get_post_thumbnail_id();
			$post_thumbnail_url = wp_get_attachment_image_src( $post_thumbnail_id, 'headerImage', false );
			
			$feed				 = new Tiles($wpdb,$title, "menschen");
			$staticMenschenFeed  = new Tiles($wpdb, $title); //empty
			
			$staticMenschenFeed->addFeed($postid, "intro");
			$staticMenschenFeed->addFeed($postid, "contact");
			//$staticMenschenFeed->addFeed(313, "linkedin");
		?>
	</head>
	
	<body>
		<header> 
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
			</div>
			<div class="imageContainer">
				<?php echo('<img src="'.$post_thumbnail_url[0].'">');?>
			</div>
		</header>

		<div class="container containerIsotope test"> 
			<div id="isotope">
				<?php
				
					foreach ($staticMenschenFeed->getTiles() as $index => $value) {
						$staticMenschenFeed->printTile($index, false);
					}
					
					foreach ($feed->getTiles() as $index => $value) {
						$feed->printTile($index, false);
					}
				?>
			</div>
		</div>
		<?php include 'footer.php'; ?>
		
	</body>	
</html>