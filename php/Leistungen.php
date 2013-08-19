<?php
	class Leistungen extends Gabelseiten{
	
		function printTile($index, $debug = false) {
			$this->generateLeistungen($index);						
		}
	
		function generateLeistungen($index){

			// Load
			
			
			$id = $this->feedData[$index]->ID;
			$metadata = get_post_meta($id, false);
				$tag = $metadata["tag"][0];
				$subtitle = $metadata["subtitle"][0];
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
						
			$postdata = get_post( $id, "ARRAY_A");			
			$postTitle = $postdata["post_title"];
			$postContent = $postdata["post_excerpt"];	
			$postSlug = $postdata["post_name"];	
					
			
		// Edit		

			
		// Print
			echo'
				<div class="item teaserTile">
					<div class="main">
						<div class="top">
							<div class="tag">
								Leistung	
							</div>
							<div class="title hyphe">
								<a href="'.$postSlug.'">'.$postTitle.'</a>		
							</div>
							<div class="subtitle">
								'.$subtitle.'		
							</div>
						</div>
						
						<div class="media">
							<img src="'.$thumbnail[0].'" class="image">
						</div>
						
						<div class="content hyphe">
							'.$postContent.'
		
						</div>
					<div class="footer">
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
							
							  WHERE post_type = "leistungen" AND post_status="publish" AND language_code="'.$language.'" AND wp_icl_translations.element_type="post_leistungen"
							  
							  ORDER BY RAND()
							  ';	
		}		
	}
	
?>