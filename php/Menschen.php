<?php
	class Menschen {
		var $feedData = false;
		var $sql = false;
		var $wpdb = false;
		var $language = false;
		
		function Menschen($wpdb, $language = false) {
			
			$this->wpdb = $wpdb;
			$this->language = $language;
			$this->createSQL($language);
			$this->initFeed();
		}
		
		function initFeed() {

			$this->feedData = $this->wpdb->get_results($this->sql);
	
		}		

		function getTiles() {
			return $this->feedData;
		}
		
		function printTile($index, $debug = false) {
			$this->generateMensch($index);						
		}

		function generateMensch($index){

			// Load
			
			
			$id = $this->feedData[$index]->ID;
			$metadata = get_post_meta($id, false);
				$tag = $metadata["tag"][0];
				$subtitle = $metadata["subtitle"][0];
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
						
			$postdata = get_post( $id, "ARRAY_A");
				$postTitle = $metadata["vorname"][0] ." ". $metadata["nachname"][0];
				$subtitle = $metadata["funktion"][0];
				$slug  = $postdata["post_title"];
		// Edit		
		
					
			$portraitUrl = MultiPostThumbnails::get_the_post_thumbnail_url('menschen', 'portrait', $id,  'personImage');

			
						
			
			$leistungenTaxonomy = get_the_terms( $id, "leistungen" );
			
			$leistungenTaxonomyString = "";
			if($leistungenTaxonomy != null){
				foreach ($leistungenTaxonomy as $value) {
							$leistungenTaxonomyString = $leistungenTaxonomyString . " " .$value->slug;
						}		
			}
			
			
		// Print
			echo'
				<div class="item menschenTile '.$leistungenTaxonomyString.'">
					<div class="main">
						<div class="top">
							<div class="tag">
								Menschen
							</div>
							<div class="title hyphe">
								<a href="/foryouandyourcustomers/menschen/'.$slug.'">'.$postTitle.'</a>	
							</div>
							<div class="subtitle">
								'.$subtitle.'		
							</div>
						</div>
						
						<div class="media">
							<img src="'.$portraitUrl.'" class="image">
						</div>
						

					</div>
					<div class="shadow">
					</div>
				</div>
			';
			return true;
		}
		
		function createSQL($language) {

				$this->sql.= 'SELECT * FROM foryouandyourcustomers.wp_posts 

							  INNER JOIN foryouandyourcustomers.wp_icl_translations 
							
							  ON wp_posts.ID=wp_icl_translations.element_id
							
							  WHERE post_type = "menschen" AND post_status="publish" AND language_code="'.$language.'" AND wp_icl_translations.element_type="post_menschen"';	
		}
		
}
	
?>