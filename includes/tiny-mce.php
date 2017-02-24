<?php
/**
 * tiny-mce.php
 * Created by: Dizzy B High
 * Email: dizzy@base5designs.co.uk.
 * User: Dizzy
 * display-innovations - 02, 2017
 */

//add stylesheet to mce editor so we can see the styles rendered while we work
add_editor_style( array(
	'assets/dist/css/editor.css'
) );

/**
 * Add "Styles" drop-down
 */
function did_mcekit_editor_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );

	return $buttons;
}

add_filter( 'mce_buttons_2', 'did_mcekit_editor_buttons' );

/**
 * Add styles/classes to the "Styles" drop-down
 */
add_filter( 'tiny_mce_before_init', 'did_mce_before_init' );

function did_mce_before_init( $settings ) {

	$style_formats = array(
		array(
			'title'   => 'Blue Border',
			'block'   => 'div',
			'classes' => 'di-borderme',
			'wrapper' => true,
		),
		array(
			'title' => 'Images container Justify - Left',
			'block'   => 'div',
			'classes' => 'flexbox-display-icons-Left',
			'wrapper' => true,
		),
		array(
			'title' => 'Images container Justify - Center',
			'block'   => 'div',
			'classes' => 'flexbox-display-icons-center',
			'wrapper' => true,
		),
		array(
			'title' => 'Images container Justify - Stretch',
			'block'   => 'div',
			'classes' => 'flexbox-display-icons-stretch',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image Standard',
			'block'   => 'div',
			'classes' => 'flexbox-display-icon-page',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image Wide',
			'inline'  => 'div',
			'classes' => 'flexbox-display-icon-page-wide',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image TAll',
			'inline'  => 'div',
			'classes' => 'flexbox-display-icon-page-tall',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image Placeholder',
			'inline'  => 'div',
			'classes' => 'flexbox-display-icon-page-placeholder',
			'wrapper' => true,
		),
		array(
			'title'   => 'video Box',
			'block'   => 'div',
			'classes' => 'video-box',
			'wrapper' => true,
		),
		array(
			'title'   => 'Client Logos Container',
			'block'   => 'div',
			'classes' => 'client-logo-container',
			'wrapper' => true,
		),
		array(
			'title'   => 'Client Logo',
			'inline'  => 'span',
			'classes' => 'client-logo',
			'wrapper' => true,
		),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}