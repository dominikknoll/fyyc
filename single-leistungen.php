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
			
			$args = array();
			$args['title'] = $title;
			$staticLeistungenFeed  = new Tiles($wpdb, $args); //empty
	
			$staticLeistungenFeed->addFeed($postid, "leistungenIntro");
			$staticLeistungenFeed->addFeed($postid, "contact");

			$args = array();
			$args['title'] 	  	  = $title;
			$args['siteType'] 	  = "leistungen";
			$feed			  	  = new Tiles($wpdb, $args);
			
			
			

			//$staticLeistungenFeed->addFeed(313, "linkedin");
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
				
					foreach ($staticLeistungenFeed->getTiles() as $index => $value) {
						$staticLeistungenFeed->printTile($index, false);
					}
					
					foreach ($feed->getTiles() as $index => $value) {
						if($index%9 == 0 && $index > 0) {
							$feed->printSpruch(($index/9)-1);
						}
						
						$feed->printTile($index, false);
						
						
					}
				?>
			</div>
		</div>
		<?php include 'footer.php'; ?>
		
	</body>	
</html>