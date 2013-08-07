<title>Frontend Template</title>
		
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<meta name = "viewport"
content = "width = 320, <!—Seite auf 1100 Pixel skalieren-->
user-scalable = yes,  <!-- Darf der User zoomen? yes/no -->
initial-scale = 0.4,  <!-- Minimaler Skalierungsfaktor -->
maximum-scale = 1 <!-- Maximaler Skalierungsfaktor. Hier 100% = scharfe Pixeldarstellung -->
"/>

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
	include("wp-content/themes/fyyc/php/Menschen.php");	

	include("wp-content/themes/fyyc/plugins/multiplePostThumbnails/multi-post-thumbnails.php");
?>

	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri()?>/plugins/fancybox/jquery.fancybox.js?v=2.1.5"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri()?>/plugins/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
		});
	</script>
	
		<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}


	</style>
	
	
    <style type="text/css">
      #map-canvas { height: 420px }
    </style>
    
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLR4jBGm9Y4xoIqk4iSS6eSeUSq-n-nJ8&sensor=false">
    </script>
    
    <script type="text/javascript">
		      function initialize() {
		
		  // Create an array of styles.
		  var styles = [
		    {
		      stylers: [
		        { saturation: -100 }
		      ]
		    }
		  ];
		
		  // Create a new StyledMapType object, passing it the array of styles,
		  // as well as the name to be displayed on the map type control.
		  var styledMap = new google.maps.StyledMapType(styles,
		    {name: "Styled Map"});
		  // Create a map object, and include the MapTypeId to add
		  // to the map type control.
		  var mapOptions = {
		    zoom: 18,
		    center: new google.maps.LatLng(48.198096, 16.359645),
		    mapTypeControlOptions: {
		      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
		    }
		  };
		  var map = new google.maps.Map(document.getElementById('map-canvas'),
		    mapOptions);
		
		  //Associate the styled map with the MapTypeId and set it to display.
		  map.mapTypes.set('map_style', styledMap);
		  map.setMapTypeId('map_style');
		}
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
	