<?php
/**
 * cmb2-page-extras.php
 * Created by: Dizzy B High
 * Email: dizzy@base5designs.co.uk.
 * User: Dizzy
 * display-innovations - 02, 2017
 */
/**
 *   Function to add banner selection meta boxes to standard pages
 */
function cmb2_page_extras_metaboxes() {

	$cmbPageExtras = new_cmb2_box( array(
		'id'           => 'pageextras',
		'title'        => 'Page Banner / Slideshow',
		'object_types' => array( 'page' ), // Post type
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true, // Show field names on the left
		'cmb_styles'   => true, // false to disable the CMB stylesheet
		// 'closed'     => true, // Keep the metabox closed by default
	) );
	$cmbPageExtras->add_field( array(
		'name'        => 'Select Banner Option',
		'id'          => $prefix . 'banneroption',
		'type'        => 'radio_inline',
		'description' => 'Default - The default banner will be shown.<br>Custom - Select a specific banner to display.<br>Slider - Enter the shortcode for the sliderr<br>None - Banner section will not be shown.',
		'options'     => array(
			'default' => __( 'default', 'cmb2' ),
			'custom'  => __( 'Custom', 'cmb2' ),
			'slider'  => __( 'Slider', 'cmb2' ),
			'none'    => __( 'None', 'cmb2' ),
		),
		'default'     => 'slider',
	) );
	$cmbPageExtras->add_field( array(
		'name'    => 'Display Banner',
		'desc'    => 'Upload Or Select an existing image to be used for this pages banner.',
		'id'      => $prefix . 'banner',
		'type'    => 'file',
		// Optional:
		'options' => array(
			'url' => false, // Hide the text input for the url
		),
		'text'    => array(
			'add_upload_file_text' => 'Upload / Select Banner Image'
			// Change upload button text. Default: "Add or Upload File"
		),
	) );

}

add_action( 'cmb2_init', 'cmb2_page_extras_metaboxes' );