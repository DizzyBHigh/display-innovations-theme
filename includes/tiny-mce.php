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
			'title'   => 'Flexbox',
			'block'   => 'div',
			'classes' => 'flexbox-display-icons',
		),
		array(
			'title'   => 'Flexbox - Centered',
			'block'   => 'div',
			'classes' => 'flexbox-display-icons-center',
		),
		array(
			'title'   => 'Flexbox Item',
			'block'   => 'div',
			'classes' => 'flexbox-display-item-video',
		),
	);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}