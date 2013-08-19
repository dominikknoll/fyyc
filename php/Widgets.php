<?php
	class Widgets {
	
		var $feed = false;
		var $active = false;
		
		var $taxonomy = false;
		var $hierarchical = false;
		var $language = false;
		var $selection = false;
		
		
		var $category_name = false;
		function Widgets($args) {
			

			$this->taxonomy 		= $this->getArgument($args, "taxonomy");
			$this->hierarchical 	= $this->getArgument($args, "hierarchical");
			$this->selection 		= $this->getArgument($args, "selection");
			$this->category_name 	= $this->getArgument($args, "category_name");
			
			
			$this->language =  ICL_LANGUAGE_CODE;


			$this->initFeed($this->category_name);	
				
			
		}
		
		
		function getArgument($args, $type) {
			if(isset($args[$type])) return $args[$type];
			else return false;
		}
		
		
		function initFeed($name) {
			
			$args = array(
					  'taxonomy'     => $this->taxonomy,
					  'orderby'      => 'count',
					  'order'         => 'DESC',
					  'pad_counts'   => 0,
					  'hierarchical' => $this->hierarchical,
					  'title_li'     => ''
					);
					$leistungenTaxonomy = get_categories( $args );
					$this->feed = $leistungenTaxonomy;
					
					$var = array();
					
					foreach ($leistungenTaxonomy as $value) {
						
						if($value->slug == $name){
						
							
							$var["slug"]  = $value->slug;
							$var["count"]  = $value->count;
							$var["name"]  = $value->name;	
							$this->active = $var;
							return true;
						}
					}
					
					return false;
			}
	


		function getFeed(){
		
			return $this->feed;
		}
		
		function getTaxonomy($art){
			
			switch($art){
				case 'tag': $this->generateTag();
					break;
				case 'cat': $this->generateCat();
					break;
			}

		}
		
		
		function generateTag(){
			echo('
					<div class="item widget">
						<div class="main">
							<h3 class="widget-title">Tags</h3>
							<h4> Was uns bewegt </h4>
				');
			
			
				echo("<ul id='filters'><div class='col'>");
				
				$i = 0;
				foreach ($this->feed  as $value) {
					$i++;
					
					$slug  = $value->slug;
					$count = $value->count;
					$name  = $value->name;	
					
					$countPosts = wp_count_posts( 'post' );
					$countedPublished = $countPosts->publish;
					$percent = ($count/$countedPublished)*91.6;
					
					echo($var["slug"]);
					
					echo('<li><div class="wrapper" style="width:'.$percent.'%"><a href="/foryouandyourcustomers/tag/'.$slug.'" >'.$name.' ('.$count.')</a></div></li>');
						
					if($i == 5){echo("<div id='hiddenTags' style='display:none'>");}
				}
				
				if($i > 4){echo("</div>");}
	
				echo("</div>");
				
				echo("<div id='showMoreTags'>Alle Tags anzeigen</div></ul>");
				
				echo('
					</div>
					<div class="shadow"/></div>
					</div>
				');
		}
		
		function generateCat(){
				echo('
					<div class="item widget">
						<div class="main">
							<h3 class="widget-title">Kategorien</h3>
							<h4 class="border"> Filtern nach Themem: </h4>
				');
				
				echo("<ul class='categoriesFilter'>");
				foreach ($this->feed  as $value) {
	
					$slug  = $value->slug;
					$count = $value->count;
					$name  = $value->name;	
					
					
					
					
					echo($var["slug"]);
					
					echo('<li><a href="/foryouandyourcustomers/category/'.$slug.'" >'.$name.' ('.$count.')</a></li>');
						
			
				}
				echo("</ul>");
				echo('
					</div>
					<div class="shadow"/></div>
					</div>
				');;
		}
		
		function generateSingleInfos($id){
		
			$contentPost = get_post($id);
			$postDate  = $contentPost->post_date;
			$postAutor = $contentPost->post_author;
			$postAutorTitle = get_the_author_meta('user_nicename',  $postAutor );
	
			$postDate=  date("d.M Y", strtotime($postDate)); 
	
			echo("<div class='item sidebarTop'>");
			echo("<p class='metahead'>Von <a href='#'>".$postAutorTitle."</a> am ".$postDate." in ");
			
			
			
			$catArray = wp_get_post_categories( $id );		
			foreach ($catArray as $value){		
				$temp = get_category($value);	
				echo("<a href='/foryouandyourcustomers/category/".$temp->name."'>".$temp->name."</a> ");
			}


			echo("</p>");
			
						
			echo("<div class='tagcloud'>");
				$tagArray = wp_get_post_tags($id) ;		
				foreach ($tagArray as $value){		
					echo("<a href='/foryouandyourcustomers/tag/".$value->name."'>#".$value->name."</a> ");
				}
			echo("</div>");
			
			
			echo("</div>");
				
		}
		
		function generateSingleShare($id){
				echo("<div class='item sidebarShare'>");
				echo("");
			echo("
				<p>Empfehlen auf Facebook</p>
				<p>Twitter</p>
				<p>Per E-Mail senden</p>
				<p>Artikel drucken</p>

			");
						echo("</div>");

		}
		
		function generateSingleSimilar($wpdb, $id){
		
			$catArray = wp_get_post_categories($id);	
			$tagArray = wp_get_post_tags($id);

			$sql = 'SELECT ID FROM foryouandyourcustomers.wp_posts as posts WHERE post_type = "post" and post_status ="publish" AND ID != "'.$id.'"
			
					AND (SELECT translations.language_code 
								FROM foryouandyourcustomers.wp_icl_translations AS translations
								WHERE posts.id = translations.element_id) = "'.$this->language.'"
	
			';
			
			$wpdb->get_results($sql);
			$result = $wpdb->last_result;
			
			$erg = array();


			foreach ($result as $value){		
				$activeID = $value->ID;
				$value = 0;
				
				$tempCatArray = wp_get_post_categories($activeID);	
					foreach ($tempCatArray as $temp){
						
						foreach ($catArray as $cat){
							if($cat == $temp){
								$value++;
							}
						}
						
					}

				$tempTagArray = wp_get_post_tags($activeID);
					foreach ($tempTagArray as $temp){
						
						foreach ($tagArray as $cat){
							if($cat == $temp){
								$value++;
							}
						}
						
					}
				
				
				$entry["id"] = $activeID;
				$entry["score"] = $value;
				
				array_push($erg, $entry);
				 
			}
			
			function cmp($b, $a)
			{
			    return strcmp($a["score"], $b["score"]);
			}
			
			usort($erg, "cmp");
			
						
			$erg = array_slice($erg, 0, 5); 
			
			echo("<div class='item sidebarMore'><div class='main'>");
			echo("<div class='otherarticles'>Ähnliche Artikel</div>");
			
				foreach ($erg as $temp){
					$tempID = $temp["id"];
					$tempScore = $temp["score"];
					$contentPost = get_post($tempID);
					$contentPost->post_title = colorupText($contentPost->post_title);
					echo("
						<p>
							<a href='".$contentPost->post_name."'>".$contentPost->post_title."</a>
						</p>
					");
	
				}
			echo("</div><div class='shadow'/></div></div>");

		
		}
		
		
}
		?>