<?php
   /*
   Template Name: updateStuff
   */
?>

<body style="font-size:14px;">
<?php  


$added = 0;

include("twitter/index.php");

	 $eintrag = "SELECT * from wp_twitterfeed";
	
	 $wpdb->query($eintrag);

	 $databaseTweets = $wpdb->last_result;
	 
	 
	 foreach ($databaseTweets as $dT) {
	 }


$userid =   "claus_stachl";


$twitterHandler = new Twitter();

$servertweets = $twitterHandler->getTimeLine($userid, false);



echo("<br><br><br><br><br>");


foreach ($servertweets as $sT) {

	$metalink  = $sT->id_str;
	$content   = $sT->text;
	
	$content = mysql_real_escape_string($content);
	
	$username  = $sT->user->screen_name;
	
	$time 	   = $sT->created_at;
	$date = date_create($time);
	$time = date_format($date, 'Y-m-d H:i:s');
	$time = (string)$time;
	
	
	$newTweet = true;
	
	
	foreach ($databaseTweets as $dT) {
		if(mysql_real_escape_string($dT->content) == $content){
			$newTweet = false;

		}
	}
		
	if($newTweet){
		$added++;

			echo($content);
						echo("<br><br>");

		
		

		$a = date('Y-m-d H:i:s');
		$eintrag = "INSERT INTO wp_twitterfeed
					(posted, priority, type, username, content, metalink)
					VALUES
					('$time', 'normal', 'twitter', '$username', '$content', '$metalink')";
	
		$wpdb->query($eintrag);
		//print_r($wpdb);
		
		mysql_connect("localhost","root","");
		mysql_select_db(foryouandyourcustomers);
		
		$q = "select MAX(id) from wp_twitterfeed";
		$result = mysql_query($q);
		$data = mysql_fetch_array($result);
		
		$id = $data[0];
				
		$eintrag = "INSERT INTO wp_twitterfeed_meta
					(twitter_id, meta_key, meta_value)
					VALUES
					('$id', 'postTarget', 'dok')";
	
		$wpdb->query($eintrag);
		
		$eintrag = "INSERT INTO wp_twitterfeed_meta
					(twitter_id, meta_key, meta_value)
					VALUES
					('$id', 'postOnFrontpage', 'yes')";
	
		$wpdb->query($eintrag);
		
		$eintrag = "INSERT INTO wp_twitterfeed_meta
					(twitter_id, meta_key, meta_value)
					VALUES
					('$id', 'postPriority', 'medium')";
	
		$wpdb->query($eintrag);
		


	}	
	
	
	
}

//echo("<br><br><br><br><br>");











/*

while($tweets[$i]->id != null and $i < 5){

$date = $tweets[$i]->created_at;

$formatted_date = date('M d Y', strtotime($date));

echo("<b style='font-weight:bold; color:black'>"); echo($formatted_date); echo("</b> &nbsp;");

$twitter_text  = $tweets[$i]->text;

$twitter_url   = $tweets[$i]->entities->urls[0]->url;

$expanded_url  = $tweets[$i]->entities->urls[0]->expanded_url;

// $image_url     = $tweets[$i]->entities->urls[0]->expanded_url;
//$media_url	  = $status->entities->media->creative->media_url;


if($screen_name != ""){
$twitter_text  = str_replace('@'.$screen_name, "<a href='http://www.twitter.com/".$screen_name."'>@".$screen_name."</a>", $twitter_text);
}
		       
$twitter_text  = str_replace($twitter_url, "<a href='".$expanded_url."'>".$twitter_url."</a>", $twitter_text);

if($image_url != ""){
//$twitter_text  = str_replace($image_url, "<a href='".$media_url."'>".$image_url."</a>", $twitter_text);   
}



echo($twitter_text);


echo("<br><br>");
$i++;

}
*/


?>




</body>
