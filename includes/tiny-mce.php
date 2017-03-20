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
			'title'   => 'Image Box - Stretch',
			'block'   => 'div',
			'classes' => 'image-box',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image Box - Center',
			'block'   => 'div',
			'classes' => 'image-box-center',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image Box - Left',
			'block'   => 'div',
			'classes' => 'image-box-left',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image Wide',
			'inline'  => 'div',
			'classes' => 'image-wide',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image TAll',
			'inline'  => 'div',
			'classes' => 'image-tall',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image 1/4',
			'inline'  => 'div',
			'classes' => 'image-quarter',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image 1/2',
			'inline'  => 'div',
			'classes' => 'image-half',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image 1/3',
			'inline'  => 'div',
			'classes' => 'image-third',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image 2/3',
			'inline'  => 'div',
			'classes' => 'image-2-third',
			'wrapper' => true,
		),
		array(
			'title'   => 'Image Placeholder',
			'inline'  => 'div',
			'classes' => 'image-placeholder',
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