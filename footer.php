<script>
	var $container = $('#isotope');
	
	$container.isotope({
    itemSelector : '.item',
    masonry : {
      columnWidth : 10
    },
    masonryHorizontal : {
      rowHeight: 10
    }
  });
	
	
	$(document).ready(function() {
	        // $('#slide').slideDown("slow");
	}); 
	$("#heroSlideButton").click(function () {
		if ($("#heroSlider").is(":hidden")) {
			$("#heroSlider").slideDown("slow");
			} else {
			$("#heroSlider").slideUp("slow");
			}		
    });
    
    $(document).ready(function() {
	        // $('#slide').slideDown("slow");
	}); 
	$("#naviSlideButtonMenschen").click(function () {
		if ($("#naviSliderMenschen").is(":hidden")) {
			$("#naviSliderMenschen").slideDown("slow");
			} else {
			$("#naviSliderMenschen").slideUp("slow");
			}		
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
			<?php include 'html/buildMap.php'; ?>
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

