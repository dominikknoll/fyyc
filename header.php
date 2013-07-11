<title>Frontend Template</title>
		
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="<?php echo get_stylesheet_directory_uri()?>/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo get_stylesheet_directory_uri()?>/css/isotope.css" rel="stylesheet" media="screen">
<link href="<?php echo get_stylesheet_directory_uri()?>/style.css" rel="stylesheet" media="screen">


<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/js/jquery.isotope.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/js/jquery.hypher.js"></script>
<script src="<?php echo get_stylesheet_directory_uri()?>/js/en-us.js"></script>

 <script>
    jQuery(function ($) {
        $('div.hyphe, div.hyphe span').hyphenate('en-us');
    });
</script>

<?php 
	include("wp-content/themes/fyyc/php/Tiles.php");	
	include("wp-content/themes/fyyc/plugins/multiplePostThumbnails/multi-post-thumbnails.php");
?>
