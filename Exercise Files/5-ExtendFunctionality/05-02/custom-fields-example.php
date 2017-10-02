<?php
/*
Plugin Name: Custom Fields Example
Description: Example demonstrating how to work with Custom Fields (Post Metadata).
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// delete custom field for each post
function myplugin_delete_custom_field( $content ) {

	/*
		delete_post_meta(
			int    $post_id,
			string $meta_key,
			mixed  $meta_value = ''
		)
	*/

	return delete_post_meta( get_the_ID(), 'weekday' );

}
// add_filter( 'the_content', 'myplugin_delete_custom_field' );










// update custom field for each post
function myplugin_update_custom_field( $content ) {

	/*
		update_post_meta(
			int    $post_id,
			string $meta_key,
			mixed  $meta_value,
			mixed  $prev_value = ''
		)
	*/

	return update_post_meta( get_the_ID(), 'mood', 'full of joy', 'happy' );

}
// add_filter( 'the_content', 'myplugin_update_custom_field' );










// add custom field for each post
function myplugin_add_custom_field( $content ) {

	/*
		add_post_meta(
			int    $post_id,
			string $meta_key,
			mixed  $meta_value,
			bool   $unique = false
		)
	*/

	$calendar = cal_to_jd( CAL_GREGORIAN, date( 'm' ), date( 'd' ), date( 'Y' ) );
	$weekday = jddayofweek( $calendar, 1 );

	return add_post_meta( get_the_ID(), 'weekday', $weekday, true );

}
// add_filter( 'the_content', 'myplugin_add_custom_field' );










// display specific custom field for each post
function myplugin_display_specific_custom_field( $content ) {

	/*
		get_post_meta(
			int $post_id,
			string $key = '',
			bool $single = false
		)
	*/

	$current_mood = get_post_meta( get_the_ID(), 'mood', true );

	$append_output  = '<div>';
	$append_output .= esc_html__( 'Feeling ' );
	$append_output .= sanitize_text_field( $current_mood );
	$append_output .= '</div>';

	return $content . $append_output;

}
// add_filter( 'the_content', 'myplugin_display_specific_custom_field' );










// display all custom fields for each post
function myplugin_display_all_custom_fields( $content ) {

	/*
		get_post_custom(
			int $post_id
		)
	*/

	$custom_fields = '<h3>Custom Fields</h3>';

	$all_custom_fields = get_post_custom();

	foreach ( $all_custom_fields as $key => $array ) {

		foreach ( $array as $value ) {

			// if ( '_' !== substr( $key, 0, 1 ) )

			$custom_fields .= '<div>'. $key .' => '. $value .'</div>';

		}

	}

	return $content . $custom_fields;

}
add_filter( 'the_content', 'myplugin_display_all_custom_fields' );


