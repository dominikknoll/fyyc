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
