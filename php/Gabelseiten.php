<?php
	class Gabelseiten {
		var $feedData = false;
		var $sql = false;
		var $wpdb = false;
		var $language = false;
		
		function Gabelseiten($wpdb, $language = false) {
			
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
		
		function countFeedData() {
			return count($this->feedData);
		}
		
		

		
		
}
	
?>