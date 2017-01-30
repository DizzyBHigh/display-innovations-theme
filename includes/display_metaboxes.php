<?php
/**
 * display_metaboxes.php
 * Created by: Dizzy B High
 * Email: dizzy@base5designs.co.uk.
 * User: Dizzy
 * display-innovations - 01, 2017
 */
/**
 * Function to add custom meta boxes to display admin pages
 */
function cmb2_display_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_did_';

	/**
	 * Initiate Metaboxes
	 */
	// Display Icon and Banner
	$cmb = new_cmb2_box( array(
		'id'           => 'display',
		'title'        => 'Display Icon and Banner',
		'object_types' => array( 'display' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => true, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );
	// Menu Label
	$cmb->add_field( array(
		'name' => 'Menu Label',
		'desc' => 'Enter the text you want on the Menu button',
		'id'   => $prefix . 'menu_label',
		'type' => 'text',
		// Optional:
	) );
	// -- Homepage Icon - File Upload
	$cmb->add_field( array(
		'id'      => $prefix . 'icon',
		'name'    => 'Display Icon',
		'desc'    => 'Upload an image to be used as the Icon for this display.',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Upload Display Icon' // Change upload button text. Default: "Add or Upload File"
		),
	) );
	// -- Page Banner - File Upload
	$cmb->add_field( array(
		'name'    => 'Display Banner',
		'desc'    => 'Upload an image to be used for the displays banner.',
		'id'      => $prefix . 'banner',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Upload Banner Image' // Change upload button text. Default: "Add or Upload File"
		),
	) );

	//Case Study Box
	$cmbCaseStudy = new_cmb2_box( array(
		'id'           => 'case_study',
		'title'        => 'Case Study',
		'object_types' => array( 'display' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => true, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default

	) );
	// -- Case Study Button Label
	$cmbCaseStudy->add_field( array(
		'name' => 'Button Label',
		'desc' => 'Enter the text you want on the case study button',
		'id'   => $prefix . 'buttonlabel',
		'type' => 'text',
		// Optional:
	) );
	// -- Case Study Images - File List
	$cmbCaseStudy->add_field( array(
		'name' => 'Case Study Images',
		'desc' => 'Select the Images for the case study',
		'id'   => $prefix . 'images',
		'type' => 'file_list'
	) );

	//Images Box
	$cmbImages = new_cmb2_box( array(
		'id'           => 'images',
		'title'        => 'Page Images',
		'object_types' => array( 'display' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => true, // false to disable the CMB stylesheet
		'closed'       => true, // Keep the metabox closed by default

	) );
	// -- Images - Icon Title Position - Radio
	$cmbImages->add_field( array(
		'name'        => 'Show Image Title',
		'id'          => $prefix . 'show_title',
		'type'        => 'radio_inline',
		'description' => 'None - No Title Shown.<br>Top - Title shown at Top.<br>Bottom - Title Shown at Bottom<br>',
		'options'     => array(
			'none'   => __( 'None', 'cmb2' ),
			'top'    => __( 'Top', 'cmb2' ),
			'bottom' => __( 'Bottom', 'cmb2' ),
		),
		'default'     => 'none',
	) );
	// -- Images - Use Popup Checkbox
	$cmbImages->add_field( array(
		'name' => 'Use Popup',
		'desc' => 'When checked the large images will be displayed in a pop-up window when clicked',
		'id'   => $prefix . 'popup',
		'type' => 'checkbox',
	) );
	// -- Images Group
	$pageImagesGroup = $cmbImages->add_field( array(
		'id'          => 'icons',
		'type'        => 'group',
		'description' => __( 'Add images for the display here.', 'cmb2' ),
		'repeatable'  => true, // use false if you want non-repeatable group
		'options'     => array(
			'group_title'   => __( 'Image {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'    => __( 'Add Image', 'cmb2' ),
			'remove_button' => __( 'Remove Image', 'cmb2' ),
			'sortable'      => true, // beta
			'closed'        => false, // true to have the groups closed by default
		),
	) );

	// -- Images Group - Stretch Options
	$cmbImages->add_group_field( $pageImagesGroup,
		array(
			'name'        => 'Container Stretch',
			'id'          => 'stretch',
			'type'        => 'radio_inline',
			'description' => 'None - Icons will appear in standard Box.<br>Wide - Boxes width will adjust to fit image - use for Wide Images.<br>Tall - Boxes Height will adjust to fit image - use for tall images<br>',
			'options'     => array(
				'none' => __( 'None', 'cmb2' ),
				'wide' => __( 'Wide', 'cmb2' ),
				'tall' => __( 'Tall', 'cmb2' ),
			),
			'default'     => 'none',
		) );
	// -- Images Group - Icon
	$cmbImages->add_group_field( $pageImagesGroup,
		array(
			'name' => 'Icon',
			'id'   => 'icon',
			'type' => 'file',
		) );

	// -- Images Group - Main Image
	$cmbImages->add_group_field( $pageImagesGroup,
		array(
			'name' => 'Image',
			'id'   => 'image',
			'type' => 'file',
		) );

	// Applications
	$cmbApplications = new_cmb2_box( array(
		'id'           => 'applications',
		'title'        => 'Applications',
		'object_types' => array( 'display' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => true, // false to disable the CMB stylesheet
		'closed'       => true, // Keep the metabox closed by default

	) );
	// -- Applications Group
	$applicationsGroup = $cmbApplications->add_field( array(
		'id'          => 'applications',
		'type'        => 'group',
		'description' => __( 'Add Applications.', 'cmb2' ),
		'repeatable'  => true, // use false if you want non-repeatable group
		'options'     => array(
			'group_title'   => __( 'Application {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
			'add_button'    => __( 'Add Application', 'cmb2' ),
			'remove_button' => __( 'Remove Application', 'cmb2' ),
			'sortable'      => true, // beta
			'closed'        => true, // true to have the groups closed by default
		),
	) );

	// Add Fields for case study Image
	$cmbApplications->add_group_field( $applicationsGroup,
		array(
			'name' => 'Application',
			'id'   => 'app',
			'type' => 'text',
		) );

	//Tech Box
	$cmbTech = new_cmb2_box( array(
		'id'           => 'tech',
		'title'        => 'Technical Specifications',
		'object_types' => array( 'display' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => true, // false to disable the CMB stylesheet
		'closed'       => false, // Keep the metabox closed by default

	) );
	// -- Type Select Radio
	$cmbTech->add_field( array(
		'name'        => 'Tech Specs',
		'id'          => $prefix . 'techtype',
		'type'        => 'radio_inline',
		'description' => 'None - Technical specifications will not be shown.<br>Default - The Default Specifications will be used. (You can set the default specs in the settings page)<br>Custom - The text entered into the Custom Specs box will be used.<br>List - The specifications added to the List will be displayed in an accordian.',
		'options'     => array(
			'none'    => __( 'None', 'cmb2' ),
			'default' => __( 'Default', 'cmb2' ),
			'custom'  => __( 'Custom', 'cmb2' ),
			'list'    => __( 'List', 'cmb2' ),
		),
		'default'     => 'default',
	) );
	// -- Custom Tech Text
	$cmbTech->add_field( array(
		'name'    => 'Custom Text',
		'desc'    => 'Enter the custom text you would like for Technical Specifications',
		'id'      => $prefix . 'custom',
		'type'    => 'wysiwyg',
		'options' => array(
			'media_buttons' => false,
		),
	),
		$cmbTech->add_field( array(
			'name'    => __( 'Technical Specifications', 'cmb2' ),
			'desc'    => __( 'Drag specs from the left column to the right column to attach them to this page.<br />You may rearrange the order of the specs in the right column by dragging and dropping.',
				'cmb2' ),
			'id'      => 'techspecs',
			'type'    => 'custom_attached_posts',
			'options' => array(
				'show_thumbnails' => true, // Show thumbnails on the left
				'filter_boxes'    => true, // Show a text box for filtering the results
				'query_args'      => array(
					'posts_per_page' => 10,
					'post_type'      => 'technical',
				), // override the get_posts args
			),
		) ) );

	// Add other metaboxes as needed

	// METABOXES FOR TECH SPECS
	/**
	 * Initiate Metaboxes
	 */
	// Display Icon and Banner Box
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

	$cmbTechSpecs->add_group_field( $techSpecsGroup,
		array(
			'name' => 'Specification',
			'desc' => 'Enter name of the Specification',
			'id'   => 'spec_name',
			'type' => 'text',
			// Optional:
		) );
	$cmbTechSpecs->add_group_field( $techSpecsGroup,
		array(
			'name' => 'Value',
			'desc' => 'Enter the Value of the Specification',
			'id'   => 'spec_value',
			'type' => 'text',
			// Optional:
		) );

}

add_action( 'cmb2_init', 'cmb2_display_metaboxes' );