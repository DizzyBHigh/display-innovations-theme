<?php
/**
 * cmb2-techspecs.php
 * Created by: Dizzy B High
 * Email: dizzy@base5designs.co.uk.
 * User: Dizzy
 * display-innovations - 02, 2017
 */

/** Function to set up Technical Specs custom post type */
function cpt_technical() {
	// Custom Post Type Labels
	$labels = array(
		'name'               => esc_html__( 'Technical specs', 'di_display' ),
		'singular_name'      => esc_html__( 'Technical spec', 'di_display' ),
		'add_new'            => esc_html__( 'Add New', 'di_display' ),
		'add_new_item'       => esc_html__( 'Add New Techspec', 'di_display' ),
		'edit_item'          => esc_html__( 'Edit Technical spec', 'di_display' ),
		'new_item'           => esc_html__( 'New Technical spec', 'di_display' ),
		'view_item'          => esc_html__( 'View Technical spec', 'di_display' ),
		'search_items'       => esc_html__( 'Search Technical spec', 'di_display' ),
		'not_found'          => esc_html__( 'No Technical spec found', 'di_display' ),
		'not_found_in_trash' => esc_html__( 'No Technical spec found in trash', 'di_display' ),
		'parent_item_colon'  => ''
	);

	// Supports
	$supports = array( 'title' );

	// Custom Post Type Supports
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'has_archive'        => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'can_export'         => true,
		'rewrite'            => array( 'slug' => 'technical', 'with_front' => true ),
		'capability_type'    => 'page',
		'hierarchical'       => false,
		'taxonomies'         => array(),
		'menu_position'      => 25,
		'supports'           => $supports,
		'menu_icon'          => get_template_directory_uri() . '/assets/dist/img/tech-spec.gif',
		// you can set your own icon here
	);

	// Finally register the "display" custom post type
	register_post_type( 'technical', $args );
	//Flush Rules
	flush_rewrite_rules();
}

/**
 * Function to add custom meta boxes to display admin pages
 */
function cmb2_techspec_metaboxes() {
	/**
	 * Initiate Metaboxes
	 */
	// Tech Specs container
	$cmbTechSpecs = new_cmb2_box( array(
		'id'           => 'technical',
		'title'        => 'Specifications',
		'object_types' => array( 'technical' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => true, // false to disable the CMB stylesheet
		'closed'       => true, // Keep the metabox closed by default
	) );
	// Tech Specs (Specification => Value) group
	$techSpecsGroup = $cmbTechSpecs->add_field( array(
		'id'          => 'tech',
		'type'        => 'group',
		'description' => __( 'Add Specifications for the display here.', 'cmb2' ),
		'repeatable'  => true, // use false if you want non-repeatable group
		'options'     => array(
			'group_title'   => __( 'Specification {#}', 'cmb2' ),
			// since version 1.1.4, {#} gets replaced by row number
			'add_button'    => __( 'Add Specification', 'cmb2' ),
			'remove_button' => __( 'Remove Specification', 'cmb2' ),
			'sortable'      => true,
			// beta
			'closed'        => true,
			// true to have the groups closed by default
		),
	) );
	// Specification
	$cmbTechSpecs->add_group_field( $techSpecsGroup,
		array(
			'name' => 'Specification',
			'desc' => 'Enter name of the Specification',
			'id'   => 'spec_name',
			'type' => 'text',
			// Optional:
		) );
	// Value
	$cmbTechSpecs->add_group_field( $techSpecsGroup,
		array(
			'name' => 'Value',
			'desc' => 'Enter the Value of the Specification',
			'id'   => 'spec_value',
			'type' => 'text',
			// Optional:
		) );

}

/**
 * Function creates post duplicate as a draft and redirects then to the edit post screen
 */
function rd_duplicate_post_as_draft() {
	global $wpdb;
	if ( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] ) || ( isset( $_REQUEST['action'] ) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die( 'No post to duplicate has been supplied!' );
	}

	/*
	 * get the original post id
	 */
	$post_id = ( isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );

	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user    = wp_get_current_user();
	$new_post_author = $current_user->ID;

	/*
	 * if post data exists, create the post duplicate
	 */
	if ( isset( $post ) && $post != null ) {

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
		$taxonomies = get_object_taxonomies( $post->post_type ); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ( $taxonomies as $taxonomy ) {
			$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
			wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
		}

		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id" );
		if ( count( $post_meta_infos ) != 0 ) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ( $post_meta_infos as $meta_info ) {
				$meta_key        = $meta_info->meta_key;
				$meta_value      = addslashes( $meta_info->meta_value );
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query .= implode( " UNION ALL ", $sql_query_sel );
			$wpdb->query( $sql_query );
		}


		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die( 'Post creation failed, could not find original post: ' . $post_id );
	}
}

/**
 * Add the duplicate link to action list for post_row_actions
 */
function rd_duplicate_post_link( $actions, $post ) {
	if ( current_user_can( 'edit_posts' ) ) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
	}

	return $actions;
}


//Register Tech Specs Post Type
add_action( 'init', 'cpt_technical' );
add_action( 'cmb2_init', 'cmb2_techspec_metaboxes' );

//Enable Duplication of Tech Specs
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );