<?php
/**
 * cpt-display.php 
 * Created by: Dizzy B High 
 * Email: dizzy@base5designs.co.uk.
 * User: Dizzy
 * Display Innovations WP - 01, 2017
 */


/**
 * Get the bootstrap! If using as a plugin, REMOVE THIS!
 */
if ( file_exists( get_template_directory() . '/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/cmb2/init.php';
}else{
	wp_die("CMB2 MetaBoxes is missing.");
};

if ( file_exists( get_template_directory() . '/cmb2-attached-posts/cmb2-attached-posts-field.php' ) ) {
	require_once get_template_directory() . '/cmb2-attached-posts/cmb2-attached-posts-field.php';
}else{
	wp_die("CMB2 MetaBoxes Attached Posts is missing.");
};

/**
 * Add The CMB2 Fields for the Displays
 */

//Template selector
//add_filter( 'template_include', 'did_template_chooser' );

//Register Display Post Type
add_action( 'init',  'cpt_display' );

//Register Display Post Type
add_action( 'init', 'cpt_technical' );

//Custom Meta Boxes


//Enable Duplication of Tech Specs
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );

add_action( 'init',  'did_set_image_sizes' );

add_action( 'did_show_home_icon','did_show_home_icon' , 10, 1  );

add_action( 'did_show_banner','did_show_banner' , 10, 1  );

add_action( 'did_displays_menu','did_displays_menu' , 10, 1  );

add_action( 'did_display_icons','did_display_icons' , 10, 1  );

add_action( 'did_show_case_studies','did_show_case_studies' , 10, 1  );

add_action( 'did_show_images','did_show_images' , 10, 1  );

/** Function to set up Display custom post type */
function cpt_display(){
	// Custom Post Type Labels
	$labels = array(
		'name' => esc_html__( 'Displays', 'di_display' ),
		'singular_name' => esc_html__( 'Display', 'di_display' ),
		'add_new' => esc_html__( 'Add New', 'di_display' ),
		'add_new_item' => esc_html__( 'Add New Display', 'di_display' ),
		'edit_item' => esc_html__( 'Edit Display', 'di_display' ),
		'new_item' => esc_html__( 'New Display', 'di_display' ),
		'view_item' => esc_html__( 'View Display', 'di_display' ),
		'search_items' => esc_html__( 'Search Display', 'di_display' ),
		'not_found' => esc_html__( 'No Display found', 'di_display' ),
		'not_found_in_trash' => esc_html__( 'No display found in trash', 'di_display' ),
		'parent_item_colon' => ''
	);

	// Supports
	$supports = array( 'title', 'editor', 'page_attributes' );

	// Custom Post Type Supports
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => 'displays', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'taxonomies' => array('category'),
		'menu_position' => 25,
		'supports' => $supports,
		'menu_icon' => get_template_directory_uri() . '/assets/dist/img/DI-icon.png', // you can set your own icon here
	);

	// Finally register the "display" custom post type
	register_post_type( 'display' , $args );

	flush_rewrite_rules();

}

/** Function to set up Technical Specs custom post type */
function cpt_technical(){
	// Custom Post Type Labels
	$labels = array(
		'name' => esc_html__( 'Technical specs', 'di_display' ),
		'singular_name' => esc_html__( 'Technical spec', 'di_display' ),
		'add_new' => esc_html__( 'Add New', 'di_display' ),
		'add_new_item' => esc_html__( 'Add New Techspec', 'di_display' ),
		'edit_item' => esc_html__( 'Edit Technical spec', 'di_display' ),
		'new_item' => esc_html__( 'New Technical spec', 'di_display' ),
		'view_item' => esc_html__( 'View Technical spec', 'di_display' ),
		'search_items' => esc_html__( 'Search Technical spec', 'di_display' ),
		'not_found' => esc_html__( 'No Technical spec found', 'di_display' ),
		'not_found_in_trash' => esc_html__( 'No Technical spec found in trash', 'di_display' ),
		'parent_item_colon' => ''
	);

	// Supports
	$supports = array( 'title' );

	// Custom Post Type Supports
	$args = array(
		'labels' => $labels,
		'public' => false,
		'has_archive' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array( 'slug' => 'technical', 'with_front' => true ),
		'capability_type' => 'page',
		'hierarchical' => false,
		'taxonomies' => array(),
		'menu_position' => 25,
		'supports' => $supports,
		'menu_icon' => get_template_directory_uri() . '/assets/dist/img/tech-spec.gif', // you can set your own icon here
	);

	// Finally register the "display" custom post type
	register_post_type( 'technical' , $args );

	flush_rewrite_rules();
}

/**
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}

	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );

	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;

	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {

		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );

		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}

		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}


		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}

/**
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}
	return $actions;
}

/**
 * Register Thumbnail sizes
 */
function did_set_image_sizes(){
	add_image_size( 'di_display_icon', '180', '143', false );
	add_image_size( 'di_banner_image', '978', '198', false );
	add_image_size( 'di_image_icon', '200', '170', false );
	add_image_size( 'di_image_icon_no_title', '210', '200', false );
	add_image_size( 'di_main_image', '730', '522', false );
}

function did_show_home_icon( $attachment_id) {
	$attachment = get_post( $attachment_id );
	$meta = did_get_post_meta($attachment_id);
	echo wp_get_attachment_image( $attachment_id , 'di_display_icon' ) .'<br>';
	echo $meta['title'];
}

function did_show_banner( $attachment_id) {
	$attachment = get_post( $attachment_id );
	$meta = did_get_post_meta($attachment_id);
	echo wp_get_attachment_image( $attachment_id , 'di_banner_image' ) .'<br>';
	echo $meta['title'];
}

function did_displays_menu(){
	$args = array(
		'posts_per_page'	=> -1, // -1 is for all
		'post_type'		=> 'display', // or 'post', 'page'
		'orderby'       => 'menu_order',
		'order' 		=> 'ASC', // or 'DESC'
	);

	$query = new WP_Query($args); //
	$last_cat = '';
	$cur_cat = '';
	$active_class = '';
	$current_page_url = did_current_url();
	$posts = $query->posts;
	if($posts) {
		foreach ( $posts as $post ) {
			$categories = get_the_category($post->ID);
			if ( ! empty( $categories ) ) {
				$last_cat = $categories[0]->name;
			}
			if($last_cat != $cur_cat){
				echo '<div class="display-button-header">' . $last_cat . '</div>';
			}
			if(get_permalink($post->ID) == $current_page_url){
				$active_class = '-active';
			}

			$menuLabel = get_post_meta($post->ID, '_did_menu_label');
			echo '<a href="' . get_permalink($post->ID) . '" class="display-menu-button'.$active_class.'">'.$menuLabel[0].'</a>';

			$cur_cat = $last_cat;
			$active_class = '';
		}
	}else{
		echo 'No Displays Installed';
	}
}

function did_display_icons(){
	$args = array(
		'posts_per_page'	=> -1, // -1 is for all
		'post_type'		=> 'display', // or 'post', 'page'
		'orderby'       => 'menu_order',
		'order' 		=> 'ASC', // or 'DESC'
	);

	$query = new WP_Query($args); //
	$last_cat = '';
	$cur_cat = '';
	$posts = $query->posts;
	if($posts) {
		foreach ( $posts as $post ) {
			$categories = get_the_category($post->ID);
			if ( ! empty( $categories ) ) {
				$cur_cat = $categories[0]->name;
			}
			if($last_cat != $cur_cat){
				echo '<div class="row small-12 medium-12 large-12">';
					echo '<div class="display-button-header-icons">' . $cur_cat . '</div>';
				echo '</div>';
			}
			$post_meta = get_post_meta( $post->ID, '', 0 ); //array of all data
			//get the post id of the icon image
			$iconID = $post_meta['_did_icon_id'][0];
			echo '<div class="flexbox-display-icon-home">';
			echo '<a class="" href="' . get_the_permalink($post->ID) .'">';
			do_action('did_show_home_icon', $iconID);
			echo '</a>';
			echo '</div>';

			$last_cat = $cur_cat;
		}
	}else{
		echo 'No Displays Installed';
	}
}

function did_show_case_studies($id) {
	//get list of case study images
	$data = get_post_meta( $id, '_did_images', 0 ); //array of case study images
	//var_dump($data);
	$buttonData = get_post_meta( $id, '_did_buttonlabel', 0 );
	$buttonText = $buttonData[0];
	$image_list = $data[0];
	//var_dump($image_list);
	//loop through urls and get the attachment ID
	$count = 1;
	if ( $image_list ) {
		foreach ( $image_list as $image_url ) {
			$attachment_id = did_get_attachment_id( $image_url );
			$image_meta    = did_get_post_meta( $attachment_id );
			//var_dump($image_meta);
			if ( $count < 2 ) {
				echo '<a class="fancybox" rel="casestudy" data-cs-title="' . $count . '" href="' . $image_url . '" alt="' . $image_meta['alt'] . '">';
					echo '<div class="case-studies-button">'.$buttonText.'</div>';
				echo '</a>';

				echo '<div class="fancybox-hidden">';// add hidden div to store titles html
					echo '<div id="cs-title-' . $count . '">';
					echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'].'</b>';
				echo '</div>';

			} else {
				echo '<a class="fancybox" rel="casestudy" data-cs-title="' . $count . '" href="' . $image_url . '" alt="' . $image_meta['alt'] . '">';
					echo '<img src="' . $image_url . '" />';
				echo '</a>';
				// add hidden div to store titles html
				echo '<div class="fancybox-hidden">';// add hidden div to store titles html
					echo '<div id="cs-title-' . $count . '">';
						echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'].'</b>';
					echo '</div>';
				echo '</div>';// end hidden div to store titles html
			}
			$count ++;
		}echo '</div>';// end hidden div to store titles html

	}
}

function did_show_images($id) {
	//get list of images
	$titlePosition = get_post_meta( $id, '_did_show_title'); //Title Position
	$popup = get_post_meta($id, '_did_popup'); //show popup check
	$align = get_post_meta( $id, '_did_align' ); //show popup check
	$iconData = get_post_meta( $id, 'icons'); //array of icons
	$icons = $iconData[0];
	$title = false;
	$count=1;
	$posData = get_post_meta( $id );
	//var_dump($iconData);
	if($icons){
		//we have Icons so check alignment
		$align_class = '';
		if ( $align[0] == 'center' ) {
			$align_class = '-center';
		}
		echo '<div class="flexbox-display-icons' . $align_class . '">';
		foreach($icons as $icon) {
			//var_dump($icon);
			$count ++;
			//get icon meta data
			$icon_meta = did_get_post_meta( $icon['icon_id'] );
			$stretch = $icon['stretch'];
			//var_dump($stretch);
			//check stretch option
			switch ( $stretch ) {
				case 'tall':
					$class = '-tall';
					break;
				case 'wide':
					$class = '-wide';
					break;
				default:
					$class = '';

			}
			//var_dump($icon['stretch']);
			$title      = $icon_meta['title'];
			$image_meta = did_get_post_meta( $icon['image_id'] );
			if ( $popup[0] == 'on' ) { //Show icons as Fancybox links
				if ( $icon['icon_id'] ) {
					echo '<a class="fancybox flexbox-display-icon-page' . $class . '" rel="images" data-i-title="' . $count . '" href="' . $image_meta['src'] . '" alt="' . $image_meta['alt'] . '">';
				} else {
					echo '<a class="fancybox fancybox-hidden" rel="images" data-i-title="' . $count . '" href="' . $image_meta['src'] . '" alt="' . $image_meta['alt'] . '">';
				}
				//show title if top or bottom is selected
				if ( $titlePosition != 'none' ) {
					if ( $titlePosition[0] == 'top' ) {
						echo $title . '<br>';
					}
					echo '<img class="di-image-icon' . $class . '" src="' . $icon_meta['src'] . '" />';
					if ( $titlePosition[0] == 'bottom' ) {
						echo '<br>' . $title;
					}
				} else {
					//show th slightly larger image as theres no title
					echo '<img class="di-image-icon_no_title' . $class . '" src="' . $icon_meta['src'] . '" />';
				}
				if ( $icon['icon_id'] ) {
					echo '</a>';
				} else {
					echo '</a>';
				}

				// add hidden div to store titles html
				echo '<div class="fancybox-hidden">';
				echo '<div id="i-title-' . $count . '">';
				echo '<b>' . $image_meta['title'] . '<br>' . $image_meta['description'] . '</b>';
				echo '</div>';
				echo '</div>';

			} else { //Show Icons Only
				echo '<div class="flexbox-display-icon-static' . $class . '">';
				//Title at Top
				if ( $titlePosition[0] == 'top' ) {
					echo $title . '<br>';
				}
				echo '<img class="di-image-icon' . $class . '" src="' . $icon_meta['src'] . '" />';
				//Title at Bottom
				if ( $titlePosition[0] == 'bottom' ) {
					echo '<br>' . $title;
				}
				echo '</div>';
			}
		}
		echo '</div>';
	}
}

// retrieves the attachment ID from the file URL
function did_get_attachment_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
	return $attachment[0];
}

function did_current_url() {
	$pageURL = 'http';
	if( isset($_SERVER["HTTPS"]) ) {
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}

	return $pageURL;
}

function did_get_post_meta( $attachment_id){
	$attachment = get_post( $attachment_id );
	$meta = array(
		'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href' => get_permalink( $attachment->ID ),
		'src' => $attachment->guid,
		'title' => $attachment->post_title
	);
	return $meta;
}
