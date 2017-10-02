<?php
/*
Plugin Name: Custom Loops: WP_Query
Description: Demonstrates how to customize the WordPress Loop using WP_Query.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// custom loop shortcode: [wp_query_example]
function custom_loop_shortcode_wp_query( $atts ) {
	
	// define shortcode variables
	extract( shortcode_atts( array( 
		
		'posts_per_page' => 5,
		'orderby' => 'date',
		
	), $atts ) );
	
	// define query parameters
	$args = array( 'posts_per_page' => $posts_per_page, 'orderby' => $orderby );
	
	// query the posts
	$posts = new WP_Query( $args );
	
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
add_shortcode( 'wp_query_example', 'custom_loop_shortcode_wp_query' );


