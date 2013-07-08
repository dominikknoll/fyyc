<?php
	class Tiles {
		var $feedData = false;
		var $sql = false;
		var $wpdb = false;
		
		function Tiles($wpdb) {
			
			$this->wpdb = $wpdb;
			$this->createSQL();
			$this->initFeed();
		}
		
		function initFeed() {
				
			//$this->debug("init Feed");
			
			$this->feedData = $this->wpdb->get_results($this->sql);
	
		}
		
		function getTiles() {
			return $this->feedData;
		}
		
		function printTile($index, $debug = false) {
			if($debug) $this->debug($this->feedData[$index]);
			
			
			switch($this->feedData[$index]->post_type) {
			
				case 'post':
					$this->generatePost($index);
				break;
				case 'teaser':
					$this->generateTeaser($index);
				break;
				case 'video':
					$this->generateVideo($index);
				break;
				case 'veranstaltung':
					$this->generateVeranstaltung($index);
				break;
				case 'twitter':
					$this->generateTwitter($index);
				break;
				case 'downloads':
					$this->generateDownloads($index);
				break;
				case 'galerie':
					$this->generateGalerie($index);
				break;
				
				
				default: 
					echo("<div class='item'><div class='top'><div class='tag'>".$this->feedData[$index]->post_type);
					if($debug) $this->debug($this->feedData[$index]);
					echo("</div></div></div>");
				break;
				
			}
			
						
		}
		
		function debug($var) {
			echo "<pre>";
			print_r($var);
			echo "</pre>";
		}
		
		function generatePost($index) {
		
		// Load
			$id = $this->feedData[$index]->post_id;
		
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
			
			$permalink = get_permalink($id);
			
			$postdata = get_post( $id, "ARRAY_A");
				$postTitle = $postdata["post_title"];
			
		// Edit		
			$postTitle = colorupText($postTitle);
			
		// Print 
			echo'
				<div class="item postTile">

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
						<a href="'.$permalink.'">
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
		
		function generateTeaser($index){

			// Load
			$id = $this->feedData[$index]->post_id;
			
			$metadata = get_post_meta($id, false);
				$tag = $metadata["tag"][0];
				$subtitle = $metadata["subtitle"][0];
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
						
			$postdata = get_post( $id, "ARRAY_A");
				$postTitle = $postdata["post_title"];
				$postContent = $postdata["post_content"];
			
		// Edit		
			$postTitle = colorupText($postTitle);
			$postContent = colorupText($postContent);


			
		// Print
			echo'
				<div class="item teaserTile">
					
					<div class="top">
						<div class="tag">
							'.$tag.'	
						</div>
						<div class="title hyphe">
							'.$postTitle.'		
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
		
		function generateVideo($index){

			// Load
			$id = $this->feedData[$index]->post_id;
			
			$metadata = get_post_meta($id, false);
				$subtitle  = $metadata["subtitle"][0];
				$medialink = $metadata["medialink"][0];
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
						
			$postdata = get_post( $id, "ARRAY_A");
				$postTitle = $postdata["post_title"];
			
		// Edit		
			$postTitle = colorupText($postTitle);	
			$editedvideoUrl = str_replace("http:", "", $metadata["medialink"][0]);
			$editedvideoUrl = str_replace("watch?v=", "embed/", $editedvideoUrl);
			
		// Print
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
							'.$subtitle.'		
						</div>
					</div>	
					<div class="media">
						
						<iframe width="100%" height="100%" src="'.$editedvideoUrl.'" frameborder="0" allowfullscreen></iframe>

					</div>
					<div class="footer">
						<a href="'.$medialink.'">
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
		
		function generateVeranstaltung($index){

			// Load
			$id = $this->feedData[$index]->post_id;
			
			$metadata = get_post_meta($id, false);
				$tag = $metadata["tag"][0];
				$subtitle = $metadata["subtitle"][0];
				$content = $metadata["content"][0];
				$time = $metadata["time"][0];
				$place = $metadata["place"][0];
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
						
			$postdata = get_post( $id, "ARRAY_A");
				$postTitle = $postdata["post_title"];
			
		// Edit		
			$postTitle = colorupText($postTitle);

		// Print
			echo'
				<div class="item veranstaltungrTile">
					
					<div class="top">
						<div class="tag">
							Event
						</div>
						<div class="title hyphe">
							'.$postTitle.'		
						</div>
						<div class="subtitle">
							'.$subtitle.'		
						</div>
					</div>

					
					<div class="content">
						
						<p>'.$time.'</p>
						<p style="color:black">'.$place.'</p>
	
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
		
		function generateTwitter($index){

		// Load
			$id	  	   = $this->feedData[$index]->post_id;
			$user	   = $this->feedData[$index]->post_title;
			$content   = $this->feedData[$index]->post_content;

		// Edit		


			
		// Print
			echo'
				<div class="item teaserTile">
					
					<div class="top">
						<div class="tag">
							@'.$user.'	
						</div>
					</div>

					<div class="content">
						'.$content.'
	
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
		
		function generateDownloads($index){
			
			
			$id = $this->feedData[$index]->post_id;
			
			$metadata = get_post_meta($id, false);
				$medialink = $metadata["medialink"][0];
						
			$postdata = get_post( $id, "ARRAY_A");
				$post_content = $postdata["post_content"];
				$post_content = colorupText($post_content);

			
			echo'
				<div class="item downloadsTile">
					<div class="top">
						<div class="tag">
							Downloads
						</div>
					</div>
					<div class="content">
						<p>'.$post_content.'</p>
						<p style="color:black"><a href="'.$medialink.'">Download</a></p>
					</div>
				</div>
			';
			return true;

		}
		
		function generateGalerie($index){

		// Load
			$id = $this->feedData[$index]->post_id;
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );

		// Edit		
			$postTitle = colorupText($metadata["title"][0]);

			
		// Print
			echo'
				<div class="item galerieTile">

					<div class="media">
						<img src="'.$thumbnail[0].'" class="image">
					</div>
					<div class="submedia">			
			';

			 MultiPostThumbnails::the_post_thumbnail('galerie', 'galerieImage1',$id,  'submedia');
			 MultiPostThumbnails::the_post_thumbnail('galerie', 'galerieImage2',$id,  'submedia');
			 MultiPostThumbnails::the_post_thumbnail('galerie', 'galerieImage3',$id,  'submedia');
			 MultiPostThumbnails::the_post_thumbnail('galerie', 'galerieImage4',$id,  'submedia');

			 echo("</div></div>");
			return true;
		}		
		
		function generateCrap(){
			echo'
				<div class="item postTile">

					<div class="top">
					
						<div class="tag">
							Crap
						</div>
						<div class="title hyphe">
						</div>

					</div>	
					<div class="media">						
					</div>
				</div>
			';
			return true;
		}	
		
		
		
		function createSQL() {
			$this->sql = '
				SELECT 
				posts.id as post_id, 
				DATEDIFF(NOW(), posts.post_date)+1 as factor_date, 
				(
					select meta_value 
						from foryouandyourcustomers.wp_postmeta as meta_priority 
					WHERE meta_priority.post_id = posts.id AND meta_priority.meta_key = "postPriority"
				) as factor_priority_name,
				(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = factor_priority_name) as factor_priority_value,
				posts.post_type as factor_type_name,
				(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = posts.post_type) as factor_type_value,
				posts.post_type,
				posts.post_title as post_title,
				posts.post_content as post_content,
				"false" as "meta_link"
				
				
				FROM foryouandyourcustomers.wp_posts as posts
				
				WHERE posts.id IN (
					SELECT id as frontpage_id
						FROM foryouandyourcustomers.wp_posts as posts
						WHERE posts.id in (
							SELECT meta.post_id
							FROM foryouandyourcustomers.wp_postmeta as meta
							WHERE meta.meta_key = "postOnFrontpage" AND meta.meta_value ="yes"
						)
					)
					AND posts.post_status = "publish"

				UNION			
				
				SELECT 
				posts.id as post_id, 
				DATEDIFF(NOW(), posts.posted)+1 as factor_date,
				(
					select meta_value 
						from foryouandyourcustomers.wp_twitterfeed_meta as meta_priority 
					WHERE meta_priority.twitter_id = posts.id AND meta_priority.meta_key = "postPriority"
				) as factor_priority_name,
				(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = factor_priority_name) as factor_priority_value,
				posts.type as factor_type_name,
				(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = posts.type) as factor_type_value,
				posts.type,
				posts.username as post_title,
				posts.content as post_content,
				"false" as "meta_link"
				
				FROM foryouandyourcustomers.wp_twitterfeed as posts
				
				WHERE posts.id IN (
					SELECT id as frontpage_id
						FROM foryouandyourcustomers.wp_twitterfeed as posts
						WHERE posts.id in (
							SELECT meta.twitter_id
							FROM foryouandyourcustomers.wp_twitterfeed_meta as meta
							WHERE meta.meta_key = "postOnFrontpage" AND meta.meta_value ="yes"
						)
					)
				
				
					ORDER BY (factor_date * factor_priority_value * factor_type_value) ASC
					LIMIT 80

			';		
		}
		
		
	}
	
	function colorupText($var){
			$var = str_replace("[", "<span style='color:black'>", $var);
			$var = str_replace("]", "</span>", $var);
			$var = str_replace("foryouandyourcustomers", "<span style='color:#73be46'>foryouandyourcustomers</span>", $var);
			return $var;
		}
	
?>