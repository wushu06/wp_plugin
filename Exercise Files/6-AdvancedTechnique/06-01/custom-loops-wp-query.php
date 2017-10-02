<?php
/*
Plugin Name: Custom Loops: WP_Query
Description: Demonstrates how to customize the WordPress Loop. Updated version demonstrates the Transients API.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.1
*/



// custom loop shortcode: [wp_query_example]
function custom_loop_wp_query_shortcode( $atts ) {



	// check if transient exists
	if ( false === ( $posts = get_transient( 'myplugin_wp_query' ) ) ) {

		// define shortcode variables
		extract( shortcode_atts( array( 'posts_per_page' => 5, 'orderby' => 'date'), $atts ) );

		// define query parameters
		$args = array( 'posts_per_page' => $posts_per_page, 'orderby' => $orderby );

		// query the posts
		$posts = new WP_Query( $args );

		// set transient to cache results for 12 hours
		set_transient( 'myplugin_wp_query', $posts, 12 * HOUR_IN_SECONDS );

	}



	// begin output variable
	$output = '<h3>'. esc_html__( 'Custom Loop Example: WP_Query', 'myplugin' ) .'</h3>';

	// begin the loop
	if ( $posts->have_posts() ) {

		while ( $posts->have_posts() ) {

			$posts->the_post();

			$output .= '<h4><a href="'. get_permalink() .'">'. get_the_title() .'</a></h4>';
			$output .= get_the_content();

		}

		// add pagination here
		// add comments here

		// reset post data
		wp_reset_postdata();

	} else {

		// if no posts are found
		$output .= esc_html__( 'Sorry, no posts matched your criteria.', 'myplugin' );

	}

	// return output
	return $output;

}
// register shortcode function
add_shortcode( 'wp_query_example', 'custom_loop_wp_query_shortcode' );










// delete transient on plugin deactivation
function custom_loop_wp_query_on_deactivation() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	delete_transient( 'myplugin_wp_query' );

}
register_deactivation_hook( __FILE__, 'custom_loop_wp_query_on_deactivation' );


