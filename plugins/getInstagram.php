<?php require 'instagram/instagram.class.php';


echo("instagram updater");

$instagram = new Instagram(array(
  'apiKey'      => '8371be1b02054549bde08e22f582cc05',
  'apiSecret'   => '946359bfbdcb4d4ab3c9ec9172d0740d',
  'apiCallback' => "false"
));


 $eintrag = "SELECT * from wp_instagramfeed";
	
	 $wpdb->query($eintrag);

	 $databaseInstagram = $wpdb->last_result;



if (true) {

  $instagram->setAccessToken("36880628.8371be1.200adb20b4fd45e3ac5c94fb9eea7765");

  $serverInstagram = $instagram->getUserMedia();

  $serverInstagram = $serverInstagram->data;

  foreach ($serverInstagram as $sT) {
  		$metalink  = $sT->images->low_resolution->url;
		$content   = $sT->caption->text;
		
		$content = mysql_real_escape_string($content);
		
		$username  = $sT->caption->from->username;
		
		$time 	   = $sT->created_time;
		
		$time = date('Y-m-d H:i:s', $time); 		
		
		
		
		
		$newTweet = true;
		
		$added=0;
		
		foreach ($databaseInstagram as $dT) {
			if(mysql_real_escape_string($dT->content) == $content){
				$newTweet = false;
	
			}
		}
		
		if($newTweet){
			$added++;
			$eintrag = "INSERT INTO wp_instagramfeed
						(posted, priority, type, username, content, metalink)
						VALUES
						('$time', 'normal', 'instagram', '$username', '$content', '$metalink')";
		
			$wpdb->query($eintrag);
			//print_r($wpdb);
			
			mysql_connect("localhost","root","");
			mysql_select_db(foryouandyourcustomers);
			
			$q = "select MAX(id) from wp_instagramfeed";
			$result = mysql_query($q);
			$data = mysql_fetch_array($result);
			
			$id = $data[0];
					
			$eintrag = "INSERT INTO wp_instagramfeed_meta
						(twitter_id, meta_key, meta_value)
						VALUES
						('$id', 'postTarget', 'dok')";
		
			$wpdb->query($eintrag);
			
			$eintrag = "INSERT INTO wp_instagramfeed_meta
						(twitter_id, meta_key, meta_value)
						VALUES
						('$id', 'postOnFrontpage', 'yes')";
		
			$wpdb->query($eintrag);
			
			$eintrag = "INSERT INTO wp_instagramfeed_meta
						(twitter_id, meta_key, meta_value)
						VALUES
						('$id', 'postPriority', 'medium')";
		
			$wpdb->query($eintrag);
		}

	}	
	
	
	
}


?>