<?php
	class Tiles {
		var $feedData = false;
		var $sql = false;
		var $wpdb = false;
		
		
		var $title 	  = false;
		var $siteType = false;
		var $blogSelector = false;
		var $sprueche = false;
		
		
		var $language =  ICL_LANGUAGE_CODE;
		

		
		function Tiles($wpdb, $args) {
			
			$this->wpdb = $wpdb;

			$this->title 		= $this->getArgument($args, "title");
			$this->siteType 	= $this->getArgument($args, "siteType");
			
			$this->blogSelector = $this->getArgument($args, "selector");
			
			$this->language =  ICL_LANGUAGE_CODE;

			$this->createSQL($this->siteType, $this->blogSelector);
			$this->initFeed();
		}
		
		
		function getArgument($args, $type) {
			if(isset($args[$type])) return $args[$type];
			else return false;
		}
		
		
		function initFeed() {
				
			//$this->debug("init Feed");
			
			$this->feedData = $this->wpdb->get_results($this->sql);
	
		}
		
		function initSprueche(){
		
		
		
			$sql = 'SELECT post_content FROM foryouandyourcustomers.wp_posts 
			
					INNER JOIN foryouandyourcustomers.wp_icl_translations 
												
					ON wp_posts.ID=wp_icl_translations.element_id
												
					WHERE post_type = "spruch" AND post_status="publish" AND language_code="'.$this->language.'" AND 
					wp_icl_translations.element_type="post_spruch"
					
					ORDER BY RAND()';
					
			$this->sprueche = $this->wpdb->get_results($sql);
					
		}
		
		function printSpruch($id) {
			
		
			if(!$this->sprueche) {
			
				$this->initSprueche();
			}
			
			if(isset($this->sprueche[$id])) {
			
				$spruchTxt = colorupText($this->sprueche[$id]->post_content);
			
				echo'
				<div class="item spruchTile">
					<div class="main">
						'.$spruchTxt.'
					</div>
				</div>
				';
			}	
		}
		
		function addFeed($id, $type, $title = false, $content = false) {
		
			$x = (object) array('post_id'	  =>$id, 
								'post_type'   =>$type,
								'post_title'  =>$title,
								'post_content'=>$content
								);
			
			if($this->feedData == false){
				
				$arr = array(0 => $x);
				$this->feedData = $arr;
				
			}
			else{
				$count = count($this->feedData);
				$count ++;
				
				$arr = array($count => $x);
				
				$this->feedData = array_merge($this->feedData, $arr);
			}

		}
		
		function get_special_metadata($table, $selector, $id){

			$sql = 'SELECT meta_key, meta_value FROM foryouandyourcustomers.'.$table.' Where '.$table.'.'.$selector.'="'.$id.'"';

			$return = $this->wpdb->get_results($sql);
			
			return $return;
		}
		
		function get_special_specific_metadata($metadata, $selector){
			foreach ($metadata as $a) {
				if($a->meta_key == $selector){
					return $a->meta_value;
				}
			
			}
		}
		
		
		
		function printTest(){
			print_r($this->feedData);
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
				case 'instagram':
					$this->generateInstagram($index);
				break;
				case 'downloads':
					$this->generateDownloads($index);
				break;
				case 'galerie':
					$this->generateGalerie($index);
				break;
				case 'slideshare':
					$this->generateSlideshare($index);
				break;
				
				
				case 'intro':
					$this->generateIntro($index);
				break;
				case 'contact':
					$this->generateContact($index);
				break;
				
				case 'leistungenIntro':
					$this->generateLeistungenIntro($index);
				break;
				

				default: 
					//echo("<div class='item'><div class='top'><div class='tag'>".$this->feedData[$index]->post_type);
					//if($debug) $this->debug($this->feedData[$index]);
					//echo("</div></div></div>");
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
				$postContent = $postdata["post_excerpt"];
				$guid = $postdata["guid"];

			
		// Edit		
			$postTitle = colorupText($postTitle);
			
		// Print 
			echo'
				<div class="item postTile">
					<div class="main">
						<div class="top">
						
							<div class="tag">
								Blog
							</div>
							<div class="title hyphe">
								<a href="'.$guid.'"> '.$postTitle.'</a>		
							</div>
							<div class="subtitle">
								'.get_the_date("l, F j, Y", $id).' by <span class="blackLink"><a>dok</a></span>		
							</div>
						</div>	
						<div class="media">						
							<img src="'.$thumbnail[0].'" class="image">
						</div>
						<div class="postContent">
								'.$postContent.'		
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
					<div class="shadow">
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
					<div class="main">
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
					<div class="shadow">
					</div>
				</div>
			';
			return true;
		}		
		
		function generateSlideshare($index){
			
			
			// Load
			$id = $this->feedData[$index]->post_id;
			
			$metadata = get_post_meta($id, false);
				$subtitle  = $metadata["subtitle"][0];
				$medialink = $metadata["medialink"][0];
						
			$postdata = get_post( $id, "ARRAY_A");
				$postTitle = $postdata["post_title"];
			
		// Edit		
			$postTitle = colorupText($postTitle);	

		// Print
			echo'
				<div class="item slideshareTile">
					<div class="main">
	
						<div class="top">
							<div class="tag">
								Slideshare
							</div>
							<div class="title hyphe">
								'.$postTitle.'		
							</div>
							<div class="subtitle">
								'.$subtitle.'		
							</div>
						</div>	
						<div class="media">
						
							<iframe 
							src="http://de.slideshare.net/slideshow/embed_code/9094451?rel=0" 
							width="308" 
							height="226" 
							frameborder="0" 
							marginwidth="0" 
							marginheight="0" 
							scrolling="no" 
							style="max-width:427px;border:1px solid #CCC;border-width:1px 1px 0" 
							allowfullscreen webkitallowfullscreen mozallowfullscreen> 
							
							</iframe> 
		
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
					<div class="shadow">
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
					<div class="main">
	
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
							
							<iframe width="300px" height="168px" src="'.$editedvideoUrl.'" frameborder="0" allowfullscreen></iframe>
	
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
					<div class="shadow">
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
				<div class="item veranstaltungsTile">
					<div class="main">
	
						<div class="top">
							<div class="tag">
								Event
							</div>
							<div class="title hyphe">
								'.$postTitle.'		
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
					<div class="shadow">
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
			
			//$var = aa();
			
			$metadata  = $this->get_special_metadata("wp_twitterfeed_meta", "twitter_id", $id);
			
			$usrImgUrl = $this->get_special_specific_metadata($metadata, "usrImageUrl");
		// Edit		


			
		// Print
			echo'
				<div class="item twitterTile">
					<div class="twitterHead">
						<div class="twitterArrow"></div>
						<img width="45px" height="45px" src="'.$usrImgUrl.'">
						<p class="name"> @'.$user.'</p>
						<p class="time"> vor 3 Stunden</p>
					</div>
					<div class="main">
						<div class="top">
						</div>
	
						<div class="content">
							'.$content.'
		
						</div>
						<div class="footer">
							15 Retweets <span class="twitterFooterRight"><span class="blackLink"><a>Antworten</a></span><span class="blackLink"><a>Retweet</a></span></span>
						</div>	
					</div>
					
					<div class="shadow"5>
					</div>
				</div>
			';
			return true;
		}
		
		function generateInstagram($index){

		// Load
			$id	  	   = $this->feedData[$index]->post_id;
			$user	   = $this->feedData[$index]->post_title;
			$content   = $this->feedData[$index]->post_content;
			$content   = $this->feedData[$index]->post_content;
			$metalink   = $this->feedData[$index]->meta_link;
			
			$metadata  = $this->get_special_metadata("wp_instagramfeed_meta", "parent_id", $id);
			
			$likes = $this->get_special_specific_metadata($metadata, "likes");

		// Edit		


			
		// Print
			echo'
				<div class="item instagramTile">
					<div class="main">
						<div class="top">
							<div class="tag">
								Instagram	
							</div>
						</div>
						
						<div class="media">
							<img src="'.$metalink.'" class="image">
						</div>
						<div class="content">
							'.$content.'
		
						</div>
						<div class="footer">
							<div class="link">
								
							</div>
							<div class="share">
								<div class="shareCount">
									'.$likes.'
								</div>
							</div>
						</div>
					</div>
					<div class="shadow">
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
					<div class="main">
						<div class="content">
							<p>'.$post_content.'</p>
							<p><span class="blackLink"><a href="'.$medialink.'">Download <span style="color: #999999"><i>(PDF, 0,44mb)</i></span></a></span></p>
						</div>
					</div>
					<div class="shadow">
					</div>
				</div>
			';
			return true;

		}
		
		function generateGalerie($index){

		// Load
			$id = $this->feedData[$index]->post_id;
			$thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImage" );
			$thumbnailBig = wp_get_attachment_image_src ( get_post_thumbnail_id($id), "tileImageRetina" );


		// Edit		
			$postTitle = colorupText($metadata["title"][0]);

			
		// Print
			echo'
				<div class="item galerieTile">
				<div class="main">

					<div class="media">
						<a class="fancybox" data-fancybox-group="gallery" href="'.$thumbnailBig[0].'"><img src="'.$thumbnail[0].'" class="image"></a>
					</div>
					<div class="submedia">			
			';

			 $a[0] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage1',$id,  'submedia');
			 $b[0] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage3',$id,  'submedia');
			 $c[0] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage3',$id,  'submedia');
			 $d[0] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage4',$id,  'submedia');
			 
			 $a[1] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage1',$id,  'tileImageRetina');
			 $b[1] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage3',$id,  'tileImageRetina');
			 $c[1] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage3',$id,  'tileImageRetina');
			 $d[1] = MultiPostThumbnails::get_the_post_thumbnail_url('galerie', 'galerieImage4',$id,  'tileImageRetina');
			 
			 //print_r($a);
			 
			 
			 echo('
			 	<a class="fancybox" data-fancybox-group="gallery" href="'.$a[1].'"><img src="'.$a[0].'"></a>
			 	<a class="fancybox" data-fancybox-group="gallery" href="'.$b[1].'"><img src="'.$b[0].'"></a>
			 	<a class="fancybox" data-fancybox-group="gallery" href="'.$c[1].'"><img src="'.$c[0].'"></a>
			 	<a class="fancybox" data-fancybox-group="gallery" href="'.$d[1].'"><img src="'.$d[0].'"></a>
			 	
			 ');

			 echo('</div>
			 
			 </div>
			 
			 <div class="shadow"></div>
			 </div>');
			return true;
		}		
		
		
		function generateIntro($index){

		// Load
			$id	  	   = $this->feedData[$index]->post_id;
			$metadata = get_post_meta($id, false);

			$content = $metadata["content"][0];
			
			$content = colorupText($content);

		// Edit		


			
		// Print
			echo'
				<div class="item introTile">
					<div class="main">
					
						<div class="content">
							'.$content.'
						</div>
					</div>
					<div class="shadow">
					</div>

				</div>
			';
			return true;
		}
		
		function generateLeistungenIntro($index){

		// Load
			$id	  	   = $this->feedData[$index]->post_id;
			
			$metadata = get_post_meta($id, false);

			$postdata = get_post( $id, "ARRAY_A");
				$post_content = $postdata["post_content"];
				$post_content = colorupText($post_content);
				

		// Edit		


			
		// Print
			echo'
				<div class="item introTile">
					<div class="main">
					
						<div class="content">
							'.$post_content.'
						</div>
					</div>
					<div class="shadow">
					</div>

				</div>
			';
			return true;
		}
		
		
		
		function generateContact($index){

		// Load
			$id	  	   = $this->feedData[$index]->post_id;
			$metadata = get_post_meta($id, false);

			$vorname = $metadata["vorname"][0];
			$nachname = $metadata["nachname"][0];
			
			$subtitle = $metadata["funktion"][0];
			$phone 	  = $metadata["phone"][0];
			$email 	  = $metadata["email"][0];
			$skype 	  = $metadata["skype"][0];

					
			$content = colorupText($content);

		// Edit		


			
		// Print
			echo'
				<div class="item contactTile">
					
					<div class="main">
						<div class="top">
							<div class="title">
								'.$vorname.' '.$nachname.'	
							</div>
							<div class="subtitle">
								'.$subtitle.'		
							</div>
						</div>
						<div class="content hyphe">
							<p class="mail">'.$email.'</p>
							<p class="phone">'.$phone.'</p>
							<p class="skype">'.$skype.'</p>
						</div>		
					</div>	
					<div class="shadow">
					</div>			
			';
			//print_r($metadata);
			echo("</div>");
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
		
		
		
		function createSQL($siteType, $selector) {
			
			if($siteType == "frontpage"){
							
				$this->sql = $this->sqlHeader("std");
				$this->sql.= $this->sqlWhere('std', 'WHERE meta.meta_key = "postOnFrontpage" AND meta.meta_value ="on"');
				
				$this->sql.= 'UNION';	
				
				$this->sql.= $this->sqlHeader("twitter");	
				$this->sql.= $this->sqlWhere("twitter", 'WHERE meta.meta_key = "postOnFrontpage" AND meta.meta_value ="on"');
				
				$this->sql.= 'UNION';	
				
				$this->sql.= $this->sqlHeader("instagram");	
				$this->sql.= $this->sqlWhere("instagram", 'WHERE meta.meta_key = "postOnFrontpage" AND meta.meta_value ="on"');
			
				$this->sql.= $this->sqlSort();						
				
				//print_r($this->sql);
				
	
			}

			
			else if($siteType == "menschen" or $siteType == "leistungen"){
					
				$this->sql = $this->sqlHeader("std");
				$this->sql.= $this->sqlWhere('std', 'WHERE meta.meta_key = "postTarget" AND meta.meta_value LIKE "%'.$this->title.'%"');
				
				$this->sql.= 'UNION';	
				
				$this->sql.= $this->sqlHeader("twitter");	
				$this->sql.= $this->sqlWhere("twitter", 'WHERE meta.meta_key = "postTarget" AND meta.meta_value LIKE "%'.$this->title.'%"');
				
				$this->sql.= 'UNION';	
				
				$this->sql.= $this->sqlHeader("instagram");	
				$this->sql.= $this->sqlWhere("instagram", 'WHERE meta.meta_key = "postTarget" AND meta.meta_value LIKE "%'.$this->title.'%"');
			
				$this->sql.= $this->sqlSort();
				
				//print_r($this->sql);
			}
			
			else if($siteType == "blog"){
						
				$this->sql = $this->sqlHeader("std");
				
				
				if($selector["art"]=="tag"){
				}

				$category_query = 'WHERE false OR term_taxonomy_id = "'.$selector["id"].' "';
				if($selector["id"] == null){$category_query="";}
				
				
				$this->sql.= '
				
					WHERE posts.id IN (
						SELECT id as frontpage_id
							FROM foryouandyourcustomers.wp_posts as posts
							WHERE posts.id in (
								SELECT meta.post_id
								FROM foryouandyourcustomers.wp_postmeta as meta
							)
						)
							AND posts.post_status = "publish" 
							
							AND (SELECT translations.language_code 
								FROM foryouandyourcustomers.wp_icl_translations AS translations
								WHERE posts.id = translations.element_id) = "'.$this->language.'"
	
							AND posts.post_type = "post"
	
							AND posts.id IN(
								SELECT object_id FROM foryouandyourcustomers.wp_term_relationships
									'.$category_query.'
							)
					';	
					
					
					$this->sql.= $this->sqlSort();

				
			}

		
	}
	function sqlHeader($type){	
		$return = "";
	
		switch($type){
			case 'std':
				$return  = '
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
				"false" as "meta_link",
				
				(SELECT translations.language_code 
				FROM foryouandyourcustomers.wp_icl_translations AS translations
				WHERE posts.id = translations.element_id) as language

				
				
				FROM foryouandyourcustomers.wp_posts as posts ';
				break;
			
			case 'twitter':
				$return = '
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
				posts.metalink as "meta_link",
				0 AS language
				
				FROM foryouandyourcustomers.wp_twitterfeed as posts ';
				break;
				
			case 'instagram':
				$return = '
						SELECT 
				posts.id as post_id, 
				DATEDIFF(NOW(), posts.posted)+1 as factor_date,
				(
					select meta_value 
						from foryouandyourcustomers.wp_instagramfeed_meta as meta_priority 
					WHERE meta_priority.parent_id = posts.id AND meta_priority.meta_key = "postPriority"
				) as factor_priority_name,
				(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = factor_priority_name) as factor_priority_value,
				posts.type as factor_type_name,
				(SELECT ranking.value from foryouandyourcustomers.wp_addon_ranking as ranking WHERE ranking.type = posts.type) as factor_type_value,
				posts.type,
				posts.username as post_title,
				posts.content as post_content,
				posts.metalink as "meta_link",
				0 AS language
				
				FROM foryouandyourcustomers.wp_instagramfeed as posts';
				
				
				//print_r($return);
				
				break;
				
			default:
			
			break;
			
		}
		
		return $return;
	}
	
	function sqlWhere($type, $query){	
		$return = "";
	
		switch($type){
			case 'std':
				$return  = '
							WHERE posts.id IN (
							SELECT id as frontpage_id
								FROM foryouandyourcustomers.wp_posts as posts
								WHERE posts.id in (
									SELECT meta.post_id
									FROM foryouandyourcustomers.wp_postmeta as meta
									'.$query.'
								)
							)
							AND posts.post_status = "publish"
							
							AND (SELECT translations.language_code 
							FROM foryouandyourcustomers.wp_icl_translations AS translations
							WHERE posts.id = translations.element_id) = "'.$this->language.'"
		
							';
				break;
			
			case 'twitter':
				$return = ' WHERE  posts.id IN (
							SELECT id as frontpage_id
								FROM foryouandyourcustomers.wp_twitterfeed as posts
								WHERE posts.id in (
									SELECT meta.twitter_id
									FROM foryouandyourcustomers.wp_twitterfeed_meta as meta
									'.$query.'
								)
							) ';
				break;
				
			case 'instagram':
				$return = ' WHERE  posts.id IN (
							SELECT id as frontpage_id
								FROM foryouandyourcustomers.wp_instagramfeed as posts
								WHERE posts.id in (
									SELECT meta.parent_id
									FROM foryouandyourcustomers.wp_instagramfeed_meta as meta
									'.$query.'
								)
							) ';
				break;
				
			default:
			
			break;
			
		}
		
		return $return;
	}
	
	function sqlSort(){
		return 'ORDER BY (factor_date * factor_priority_value * factor_type_value) ASC
				LIMIT 36 ';
	}
	
	

	
}
	

?>