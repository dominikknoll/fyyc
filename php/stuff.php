<?php
	function colorupText($var){
		$var = str_replace("[", "<span style='color:black'>", $var);
		$var = str_replace("]", "</span>", $var);
		$var = str_replace("foryouandyourcustomers", "<span style='color:#73be46'>foryouandyourcustomers</span>", $var);
		return $var;
	}
	
	function buildHero($var){
	
		$var = colorupText($var);
	
		echo('
			<div class="hero-unit hyphe">
				<div class="titeltxt">'.$var.'</div>
			</div>
		');
		
	}
	
	
?>