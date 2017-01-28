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

/**
 * Create Logo Setting and Upload Control
 */
function di_Default_banner_customizer_settings($wp_customize) {
// add a setting for the site logo
	$wp_customize->add_setting('di_default_banner');
// Add a control to upload the banner
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'di_default_banner',
		array(
			'label' => 'Upload Default Banner',
			'section' => 'title_tagline',
			'settings' => 'di_default_banner',
		) ) );
}
add_action('customize_register', 'di_default_banner_customizer_settings');

function di_show_default_banner($banner_url){
	$banner_id = attachment_url_to_postid($banner_url);

}