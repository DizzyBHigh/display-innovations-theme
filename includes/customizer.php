<?php
/**
 * Heisenberg Theme Customizer.
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
add_action( 'customize_register', function( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
} );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
add_action( 'customize_preview_init', function() {
	wp_enqueue_script(
		'heisenberg_customizer',
		HEISENBERG_URL . '/assets/js/customizer.js',
		['customize-preview'],
		HEISENBERG_VERSION,
		true
	);
} );


//add tech specs panel
function di_defaults_customizer_register( $wp_customize ) {

	$wp_customize->add_panel( 'di_display_defaults',
		array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Display Defaults', 'display-innovations' ),
			'description'    => __( 'Manage Display Defaults.', 'display-innovations' ),
		) );

	$wp_customize->add_section( 'di_section_default_banner',
		array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Default Banner', 'display-innovations' ),
			'description'    => 'The Default Banner ( used by the default banner option in Displays',
			'panel'          => 'di_display_defaults',
		) );

	$wp_customize->add_section( 'di_section_tech_specs',
		array(
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __( 'Technical Specs', 'display-innovations' ),
			'description'    => '',
			'panel'          => 'di_display_defaults',
		) );
	// add a setting for the site logo
	$wp_customize->add_setting('di_default_banner');
	// Add a control to upload the banner
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'di_default_banner',
		array(
			'label' => 'Upload Default Banner',
			'section' => 'di_section_default_banner',
			'settings' => 'di_default_banner',
		) ) );

	$wp_customize->add_setting( 'di_default_tech_specs',
		array(
			'default'    => '',
			'type'       => 'theme_mod',
			'capability' => 'edit_theme_options',
			'transport'  => '',
			//'sanitize_callback' => 'esc_textarea',
		) );

	$wp_customize->add_control( 'di_default_tech_specs',
		array(
			'type'        => 'textarea',
			'priority'    => 10,
			'section'     => 'di_section_tech_specs',
			'label'       => __( 'Default Technical Specs', 'display-innovations' ),
			'description' => 'Default Technical Specifications',
		) );


}

add_action( 'customize_register', 'di_defaults_customizer_register' );


