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

//Register Tech Specs Post Type
add_action( 'init', 'cpt_technical' );
add_action( 'cmb2_init', 'cmb2_techspec_metaboxes' );