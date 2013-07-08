<?php 

function wpt_event_posttype() {

	
	register_post_type( 'menschen',
		array(
			'labels' => array(
				'name' => __( 'Menschen' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	/*
	register_post_type( 'standorte',
		array(
			'labels' => array(
				'name' => __( 'Standorte' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	
	register_post_type( 'produkte',
		array(
			'labels' => array(
				'name' => __( 'Produkte' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);

	*/
	
	register_post_type( 'downloads',
		array(
			'labels' => array(
				'name' => __( 'Downloads' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	
	register_post_type( 'teaser',
		array(
			'labels' => array(
				'name' => __( 'Teaser' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	register_post_type( 'menschenteaser',
		array(
			'labels' => array(
				'name' => __( 'Menschenteaser' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	
	register_post_type( 'links',
		array(
			'labels' => array(
				'name' => __( 'Links' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	
	register_post_type( 'veranstaltung',
		array(
			'labels' => array(
				'name' => __( 'Veranstaltung' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	
	register_post_type( 'video',
		array(
			'labels' => array(
				'name' => __( 'Video' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'
		)
	);
	
	register_post_type( 'galerie',
		array(
			'labels' => array(
				'name' => __( 'Galerie' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'thumbnail'),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'
		)
	);

	/*
	register_post_type( 'cpt',
		array(
			'labels' => array(
				'name' => __( 'Cpt' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'rewrite' => array("slug" => "menschen", "with_front" => false), // Permalinks format
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);
	
	*/
	
	
		
}


add_action( 'init', 'wpt_event_posttype' );
?>