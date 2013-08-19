<!DOCTYPE HTML >
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">



<html>
	<head>
		<?php get_header(); wp_head(); ?>

		<link href="<?php echo get_stylesheet_directory_uri()?>/css/blog.css" rel="stylesheet" media="screen">
		<link href="<?php echo get_stylesheet_directory_uri()?>/css/single.css" rel="stylesheet" media="screen">
		
		<?php
			$postId =  get_the_ID(); 
			$contentPost = get_post($postId);

		?>
		
	</head>
	
	<body>

		<header>
			<div class="container">	
				<?php include 'html/buildHeader.php'; ?>	
				<?php buildHero($contentPost->post_title); ?>	
				
				<?php
				
				$args = array();
				$widget = new Widgets($args);
				
				?>

			</div>
		</header>

		<div class="container containerIsotope"> 
			<div id="isotope" class="blogMain">
				<div class="item"> 
					<div class="main" id="content">
						
							<?php 
								$postdata = get_post( $postId, "ARRAY_A");			
								$excerp   = $postdata["post_excerpt"];	
								echo("<p>".$excerp."</p>");
							?>

						 
							<?php 
							
								$content = $contentPost->post_content;
								$content = apply_filters('the_content', $content);
								$content = str_replace(']]>', ']]&gt;', $content);
								
								echo($content); 
								

							?>
					</div>
				</div>
			</div>
			
			
			<div id="isotope" class="blogNavi">
			
					<?php 
					$widget->generateSingleInfos(get_the_ID()); 
					$widget->generateSingleShare(get_the_ID());
					$widget->generateSingleSimilar($wpdb, get_the_ID());
					
					?>
					
					<?php dynamic_sidebar ('sidebar-1');?>
					

			</div>
		</div>
		
		<?php include 'footer.php'; ?>
		
	</body>	
</html>