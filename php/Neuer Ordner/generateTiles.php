<?php
		function colorupText($var){
			$var = str_replace("[", "<span style='color:black'>", $var);
			$var = str_replace("]", "</span>", $var);
			$var = str_replace("foryouandyourcustomers", "<span style='color:#73be46'>foryouandyourcustomers</span>", $var);
			return $var;
		}
	
		function generateTiles($id, $type){
	
			//print_r(get_post_meta($id, false)); 
			$metadata = get_post_meta($id, false);
			
	
		if($type == "video"){

			$editedvideoUrl = str_replace("http:", "", $metadata["medialink"][0]);
			$editedvideoUrl = str_replace("watch?v=", "embed/", $editedvideoUrl);
			
			$postTitle = colorupText($metadata["title"][0]);

			echo'
				<div class="item videoTile">
					
					<div class="top">
						<div class="tag">
							Video
						</div>
						<div class="title hyphe">
							'.$postTitle.'		
						</div>
						<div class="subtitle">
							'.$metadata["subtitle"][0].'		
						</div>
					</div>	
					<div class="media">
						
						<iframe width="100%" height="100%" src="'.$editedvideoUrl.'" frameborder="0" allowfullscreen></iframe>

					</div>
					<div class="footer">
						<a href="'.$metadata["medialink"][0].'">
						<div class="link">
							
						</div>
						</a>
						<div class="share">
							<div class="shareCount">
								15
							</div>
						</div>
						
					</div>
				</div>
			';
			return true;
		}
		
		if($type == "post"){
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
			
			$postdata = get_post( $id, "ARRAY_A");
			//print_r($postdata);	
			
			$postTitle = colorupText($postdata["post_title"]);

			echo'
				<div class="item videoTile">
					
					<div class="top">
						<div class="tag">
							Blog
						</div>
						<div class="title hyphe">
							'.$postTitle.'		
						</div>
						<div class="subtitle">
							'.get_the_date("l, F j, Y", $id).' by dok		
						</div>
					</div>	
					<div class="media">
						
						<img src="'.$thumbnail[0].'" class="image">


					</div>
					<div class="footer">
						<a href="'.get_permalink().'">
							<div class="link">
								
							</div>
						</a>

						<div class="share">
							<div class="shareCount">
								15
							</div>
						</div>
						
					</div>
				</div>
			';
			return true;
		}

		if($type == "teaser"){
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
			
			$postTitle = colorupText($metadata["title"][0]);

			echo'
				<div class="item teaserTile">
					
					<div class="top">
						<div class="tag">
							'.$metadata["tag"][0].'	
						</div>
						<div class="title hyphe">
							'.$postTitle.'		
						</div>
						<div class="subtitle">
							'.$metadata["subtitle"][0].'		
						</div>
					</div>
					
					<div class="media">
						<img src="'.$thumbnail[0].'" class="image">
					</div>
					
					<div class="content">
						'.$metadata["content"][0].'
	
					</div>
					<div class="footer">
						<div class="link">
							
						</div>
						<div class="share">
							<div class="shareCount">
								15
							</div>
						</div>
						
					</div>
				</div>
			';
			return true;
		}
		if($type == "veranstaltung"){
		
		
		
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
			
			$postdata = get_post( $id, "ARRAY_A");
			//print_r($postdata);	
			
			$postTitle = colorupText($postdata["post_title"]);
			

			echo'
				<div class="item teaserTile">
					
					<div class="top">
						<div class="tag">
							Event
						</div>
						<div class="title hyphe">
							'.$postTitle.'		
						</div>
						<div class="subtitle">
							'.$metadata["subtitle"][0].'		
						</div>
					</div>

					
					<div class="content">
						
						<p>'.$metadata["time"][0].'</p>
						<p style="color:black">'.$metadata["place"][0].'</p>
	
					</div>
					<div class="footer">
						<div class="link">
							
						</div>
						<div class="share">
							<div class="shareCount">
								15
							</div>
						</div>
						
					</div>
				</div>
			';
			return true;
		}
		
		if($type == "downloads"){			
			//print_r($postdata);	
			
			$postTitle = colorupText($metadata["title"][0]);

			

			echo'
				<div class="item teaserTile">
									
					<div class="content">
						<p>'.$postTitle.'</p>
						<p style="color:black"><a href="'.$metadata["medialink"][0].'">Download</a></p>
					</div>
				</div>
			';
			return true;
		}
		
		else{
			echo'
				<div class="item teaserTile">
					
					<div class="top">
						<div class="tag">
							'.$type.'	
						</div>

					</div>
				</div>
			';
			return true;
		}
		
	}
?>