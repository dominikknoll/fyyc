<script>

	
	
  
  
	
	
	$(document).ready(function() {
			var $container = $('#isotope');
			
	       $container.imagesLoaded( function(){
			 $container.isotope({
			    itemSelector : '.item',
			    masonry : {
			      columnWidth : 10
			    },
			    masonryHorizontal : {
			      rowHeight: 10
			    }
			  });
		});

    	
		$("#heroSlideButton").click(function () {
			if ($("#heroSlider").is(":hidden")) {
				$("#heroSlider").slideDown("slow");
				$('#heroSlideButton span').css("background", "url('<?php echo get_stylesheet_directory_uri()?>/img/icons/arrowup.png') no-repeat scroll left top");	
				$('#heroSlideButton span').css("background-position-y", "2px");	
	
				;		
				} else {
				$("#heroSlider").slideUp("slow");
				$('#heroSlideButton span').css("background", "url('<?php echo get_stylesheet_directory_uri()?>/img/icons/arrowdown.png') no-repeat scroll left top");	
				$('#heroSlideButton span').css("background-position-y", "2px");	
	
				}		
	    });
	    
	    $("#naviSlideButtonMenschen").click(function () {
			if ($("#naviSliderMenschen").is(":hidden")) {
				$("#naviSliderMenschen").slideDown("slow");
				} else {
				$("#naviSliderMenschen").slideUp("slow");
				}		
		    });	
    }); 
	

</script>

<footer>
	<div class="container mapContainer">	
		<div class="top">
			<div class="left"><span style="color:#73be46 !important">foryouandyourcustomers</span> gibt's in Amsterdam, Genf, München, <span style="color:black !important">Wien</span> und Zürich</div>
			<div class="right">Kontakt Offene Stellen T F B</div>
		</div>
	</div>
		<div class="map">
			<div id="map-canvas"> </div>
		</div>
	<div class="footerBottom">
		<div class="container mapContainer">	
	
			<div class="bottom">
				<div class="left">Copyright 2013 foryouandyourcustomers AG</div>
				<div class="right">Impressum AGB</div>
			</div>
		</div>
	</div>
</footer>

