<?php 

function twentyeleven_widgets_init() {


	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentyeleven' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div class="item widget"><div class="main">',
		'after_widget' => '</div><div class="shadow"></div></div>',
		'before_title' => '<h3 class="item widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentyeleven_widgets_init' );


define('WP_POST_REVISIONS', false);


function saveMetadata($events_meta, $postId){
		foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
			if( $post->post_type == 'revision' ) return; // Don't store custom data twice
			$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
			if(get_post_meta($postId, $key, FALSE)) { // If the custom field already has a value
				update_post_meta($postId, $key, $value);
			} else { // If the custom field doesn't have a value
				add_post_meta($postId, $key, $value, true);
			}
			if(!$value) delete_post_meta($postId, $key); // Delete if blank
		}
	}

include("plugins/multiplePostThumbnails/multi-post-thumbnails.php");
	

    
if (class_exists('MultiPostThumbnails')) {
     new MultiPostThumbnails(array(
        'label' => 'Portrait',
        'id' => 'portrait',
        'post_type' => 'menschen'
        )
    );
    
    new MultiPostThumbnails(array(
        'label' => 'galerieImage1',
        'id' => 'galerieImage1',
        'post_type' => 'galerie'
        )
    );
    new MultiPostThumbnails(array(
        'label' => 'galerieImage2',
        'id' => 'galerieImage2',
        'post_type' => 'galerie'
        )
    );
    new MultiPostThumbnails(array(
        'label' => 'galerieImage3',
        'id' => 'galerieImage3',
        'post_type' => 'galerie'
        )
    );
    new MultiPostThumbnails(array(
        'label' => 'galerieImage4',
        'id' => 'galerieImage4',
        'post_type' => 'galerie'
        )
    );      
 
};



add_action ( 'load-post.php', 'add_events_metaboxes' );
add_action ( 'load-post-new.php', 'add_events_metaboxes' );


// Enable thumbnails

add_theme_support( 'post-thumbnails' );

//set_post_thumbnail_size(300, 200, true); // Normal post thumbnails

add_image_size('submedia', 145, 81, true);
add_image_size( "tileImage", 300, 0, false );

add_image_size( "personImage", 310, 310, true );

add_image_size( "tileImageRetina", 900, 0, false );

add_image_size( "headerImage", 1280, 720, true );




add_action( 'admin_menu', 'smu_remove_menu_pages' );
 
function smu_remove_menu_pages() {
    remove_menu_page('upload.php');                 // Entfernt den Punkt Mediathek
}

// Customise the footer in admin area
function wpfme_footer_admin () {
	echo 'Theme designed and developed by <a href="#" target="_blank">YourNameHere</a> and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
}
add_filter('admin_footer_text', 'wpfme_footer_admin');


function create_my_taxonomies() {
    register_taxonomy(
        'leistungen',
        'menschen',
        array(
            'labels' => array(
                'name' => 'Leistungen',
                'add_new_item' => 'Add New Leistungen',
                'new_item_name' => "New Movie Leistungen"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
    
    }

add_action( 'init', 'create_my_taxonomies', 0 );

// Add custom menus
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', 'wpfme' ),
	//'example' => __( 'Example Navigation', 'wpfme' ),
) );

function wpt_save_events_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
			// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	//Menschen
	
	
	//General Information
	
	$events_meta_ml = array(); //multilingual

	
	$events_meta['postTarget']      = $_POST['postTarget'];
	$events_meta['postPriority']    = $_POST['postPriority'];
	$events_meta['postOnFrontpage'] = $_POST['postOnFrontpage'];
	
	$events_meta_ml['vorname']		= $_POST['vorname'];
	$events_meta_ml['nachname'] 	= $_POST['nachname'];
	$events_meta_ml['email']		= $_POST['email'];
	$events_meta_ml['standort'] 	= $_POST['standort'];
	$events_meta_ml['phone'] 	 	= $_POST['phone'];

	
	
	$events_meta_ml['twitter']		= $_POST['twitter'];
	$events_meta_ml['instagram'] 	= $_POST['instagram'];
	$events_meta_ml['linkedin']  	= $_POST['linkedin'];
	$events_meta_ml['skype'] 	 	= $_POST['skype'];
	
	$events_meta['funktion']		= $_POST['funktion'];
	$events_meta['downloads'] 		= $_POST['downloads'];
	
	$events_meta['tag']				= $_POST['tag'];
	$events_meta['title'] 			= $_POST['title'];
	$events_meta['subtitle']		= $_POST['subtitle'];
	$events_meta['medialink'] 		= $_POST['medialink'];
	$events_meta['content']			= $_POST['content'];
	$events_meta['link'] 			= $_POST['link'];
	
	$events_meta['time']			= $_POST['time'];
	$events_meta['place'] 			= $_POST['place'];
	
	
	
	
	$post_type = $post->post_type;

	$enID = icl_object_id($post->ID,$post_type, false, 'en');
	$deID = icl_object_id($post->ID,$post_type, false, 'de');
	
	saveMetadata($events_meta, $post->ID);
	saveMetadata($events_meta_ml, $enID);
	saveMetadata($events_meta_ml, $deID);
	
	//echo("<br>allg");echo($post->ID);
	//echo("<br>en");echo(icl_object_id($post->ID,$post_type, false, 'en')); 
	//echo("<br>de");echo(icl_object_id($post->ID,$post_type, false, 'de')); 
	
	
	


}

add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fields


function add_events_metaboxes() {
	//add_meta_box('menschen_metadaten_formular', 'Metadaten', 'menschen_metadaten_formular', 'cpt', 'normal', 'high');
	//add_meta_box('menschen_metadaten_formular', 'Metadaten', 'menschen_metadaten_formular', 'video', 'normal', 'high');
	


	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'post', 'normal', 'high');
	
	
	add_meta_box('metadatenDownloads', 'Content', 'metadatenDownloads', 'downloads', 'normal', 'high');
	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'downloads', 'normal', 'high');
	

	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'teaser', 'normal', 'high');
	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'menschenteaser', 'normal', 'high');
	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'links', 'normal', 'high');
	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'veranstaltung', 'normal', 'high');
	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'video', 'normal', 'high');
	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'galerie', 'normal', 'high');
	add_meta_box('metadatenPriority', 'Priority', 'metadatenPriority', 'slideshare', 'normal', 'high');



	
	add_meta_box('metadatenTeaser', 'Content', 'metadatenTeaser', 'teaser', 'normal', 'high');
	add_meta_box('metadatenVideo', 'Content', 'metadatenVideo', 'video', 'normal', 'high');
	add_meta_box('metadatenVideo', 'Content', 'metadatenVideo', 'slideshare', 'normal', 'high');
	
	
	add_meta_box('metadatenVeranstaltung', 'Zeit und Ort', 'metadatenVeranstaltung', 'veranstaltung', 'normal', 'high');



	
	add_meta_box('metadatenKontaktdatenMenschen', 'Kontaktdaten Menschen', 'metadatenKontaktdatenMenschen', 'menschen', 'normal', 'high');
	add_meta_box('metadatenNetzwerkMenschen', 'Netzwerkinformationen Menschen', 'metadatenNetzwerkMenschen', 'menschen', 'normal', 'high');
	add_meta_box('metadatenZusatzinfosMenschen', 'Sprachensensitive Zusatzinfos Menschen', 'metadatenZusatzinfosMenschen', 'menschen', 'normal', 'high');



}



		
function metadatenPriority() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
				
	$postTarget    	 		= get_post_meta($post->ID, 'postTarget', true);
	$postPriority        	= get_post_meta($post->ID, 'postPriority', true);
	$postOnFrontpage        = get_post_meta($post->ID, 'postOnFrontpage', true);
	
	if($postOnFrontpage == "on") {$checked = "checked";}
	echo($checked);
		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Put This post on the following Sites</td>
					<td>
					<textarea name="postTarget">' . $postTarget  . '</textarea>
					
					
					
					</td>
				</tr>
				
				<tr>
					<td>This is the Post Priority</td>
					<td><input name="postPriority" value="' . $postPriority  . '"></td>
				</tr>
				
				<tr>
					<td>This is the Post should Appear on the Mainpage</td>
					<td><input type="checkbox" name="postOnFrontpage" ' . $checked  . '=' . $checked  . '"></td>
				</tr>
			</table>
		'; 
	}
	
	
function metadatenKontaktdatenMenschen() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
				
	$vorname    = get_post_meta($post->ID, 'vorname', true);
	$nachname   = get_post_meta($post->ID, 'nachname', true);
	$email		= get_post_meta($post->ID, 'email', true);
	$standort	= get_post_meta($post->ID, 'standort', true);
	$phone		= get_post_meta($post->ID, 'phone', true);



	
		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Vorname</td>
					<td><input name="vorname" value="' . $vorname  . '"></td>
				</tr>
				
				<tr>
					<td>Nachname</td>
					<td><input name="nachname" value="' . $nachname  . '"></td>
				</tr>
				
				<tr>
					<td>E-Mail</td>
					<td><input name="email" value="' . $email  . '"></td>
				</tr>
				<tr>
					<td>Standort</td>
					<td><input name="standort" value="' . $standort  . '"></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input name="phone" value="' . $phone  . '"></td>
				</tr>
			</table>
		'; 
	}

function metadatenNetzwerkMenschen() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
				
	$twitter  		 = get_post_meta($post->ID, 'twitter', true);
	$instagram		 = get_post_meta($post->ID, 'instagram', true);
	$linkedin		 = get_post_meta($post->ID, 'linkedin', true);
	$skype			 = get_post_meta($post->ID, 'skype', true);



	
		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Twitter</td>
					<td><input name="twitter" value="' . $twitter  . '"></td>
				</tr>
				
				<tr>
					<td>Instagram</td>
					<td><input name="instagram" value="' . $instagram  . '"></td>
				</tr>
				<tr>
					<td>LinkedIn</td>
					<td><input name="linkedin" value="' . $linkedin  . '"></td>
			</tr>
				<tr>
					<td>skype</td>
					<td><input name="skype" value="' . $skype  . '"></td>
				</tr>
				
			</table>
		'; 
	}

function metadatenZusatzinfosMenschen() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
				
	$funktion  		 = get_post_meta($post->ID, 'funktion', true);
	$downloads		 = get_post_meta($post->ID, 'downloads', true);

		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Funktion</td>
					<td><input name="funktion" value="' . $funktion  . '"></td>
				</tr>
				
				<tr>
					<td>Downloads</td>
					<td><input name="downloads" value="' . $downloads  . '"></td>
				</tr>			
			</table>
		'; 
	}

function metadatenTeaser() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
				
	$tag  		 	 = get_post_meta($post->ID, 'tag', true);
	$subtitle  		 = get_post_meta($post->ID, 'subtitle', true);
	$link		 	 = get_post_meta($post->ID, 'link', true);

		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Tag</td>
					<td><input name="tag" value="' . $tag  . '"></td>
				</tr>
				<tr>
					<td>Subtitle</td>
					<td><input name="subtitle" value="' . $subtitle  . '"></td>
				</tr>	
				<tr>
					<td>Link</td>
					<td><input name="link" value="' . $link  . '"></td>
				</tr>
			</table>
		'; 
	}

function metadatenVideo() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$subtitle  		 = get_post_meta($post->ID, 'subtitle', true);
	$medialink		 = get_post_meta($post->ID, 'medialink', true);
	
		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Subtitle</td>
					<td><input name="subtitle" value="' . $subtitle  . '"></td>
				</tr>	
				<tr>
					<td>Media Link</td>
					<td><input name="medialink" value="' . $medialink  . '"></td>
				</tr>	
			</table>
		'; 
	}

function metadatenVeranstaltung() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$time		 	 	= get_post_meta($post->ID, 'time', true);
	$place  		 	= get_post_meta($post->ID, 'place', true);
	$link		 	 = get_post_meta($post->ID, 'link', true);

		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Zeit</td>
					<td><input name="time" value="' . $time  . '"></td>
				</tr>	
				<tr>
					<td>Ort</td>
					<td><input name="place" value="' . $place  . '"></td>
				</tr>	
				<tr>
					<td>Link</td>
					<td><input name="link" value="' . $link  . '"></td>
				</tr>
			</table>
		'; 
	}

function metadatenDownloads() {
	global $post;
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$medialink		 = get_post_meta($post->ID, 'medialink', true);
	
		echo '
		    <table style="display: inline-block; padding: 30px;">
				<tr>
					<td>Media Link</td>
					<td><input name="medialink" value="' . $medialink  . '"></td>
				</tr>	
			</table>
		'; 
	}


		



// Registriere Post type Mensch

define('WP_POST_REVISIONS', false);


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
			'has_archive' => true,

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
	*/
	register_post_type( 'leistungen',
		array(
			'labels' => array(
				'name' => __( 'Leistungen' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'has_archive' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'

		)
	);

	
	
	register_post_type( 'downloads',
		array(
			'labels' => array(
				'name' => __( 'Downloads' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
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
			'' => array("slug" => "menschen", "with_front" => false), // Permalinks format
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
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'
		)
	);
	
	
	register_post_type( 'slideshare',
		array(
			'labels' => array(
				'name' => __( 'Slideshare' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
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
			'menu_position' => 5,
			'register_meta_box_cb' => 'add_events_metaboxes'
		)
	);
	
	register_post_type( 'spruch',
		array(
			'labels' => array(
				'name' => __( 'Spruch' ),
			),			
			'public' => true,
			'supports' => array( 'title', 'editor'),
			'show_in_nav_menus' => true,			
			'capability_type' => 'post',
			'menu_position' => 5
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
