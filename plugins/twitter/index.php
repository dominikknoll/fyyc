<?php
/**
 * @file
 * User has successfully authenticated with Twitter. Access tokens saved to session and DB.
 */


class Twitter {
	
	public $connection = false;
	public $connected = false;
   
	function __construct() {
		$this->connectTwitter();
	}
	
	function connectTwitter() {
		/* Load required lib files. */
		session_start();
		//unset($_SESSION['access_token']));
		
		//$this->debug($_SESSION);
		
		require_once('twitteroauth/twitteroauth.php');
		require_once('config.php');
		
		/* If access tokens are not available redirect to connect page. */
		if (empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
		    header('Location: ./clearsessions.php');
		}
		/* Get user access tokens out of the session. */
		$access_token = $_SESSION['access_token'];
		
		//$this->debug($_SESSION);
				
		$this->connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, "1341290024-PPBMngYuHqXMSZokjQDcMB6gs0EHoY875MZ8CcM", "jT6fqRtXm9JvKLjqr5qnOqO6VCOaw6ns79Kjhc24");	

		//$this->debug($content);
	}
	
	function getTimeLine($screenName, $debug = false) {
		if(!$this->connection) $this->connectTwitter();
		
		$return = $this->connection->get('statuses/user_timeline', array('screen_name' => $screenName));
		
		if($debug) {
			$this->debug($return);
		}
		
		return $return;
	}
	
	function debug($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}
}