<?php


	function saveMetadata($events_meta, $postId){
		foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
			if( $post->post_type == 'revision' ) return; // Don't store custom data twice
			$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
			if(get_post_meta($postId, $key, FALSE)) { // If the custom field already has a value
				update_post_meta($postId, $key, $value);
			} else { // If the custom field doesn't have a value
				add_post_meta($postId, $key, $value);
			}
			if(!$value) delete_post_meta($postId, $key); // Delete if blank
		}
	}
	

?>