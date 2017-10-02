<?php
/*
Plugin Name: Custom Loops: pre_get_posts
Description: Demonstrates how to customize the WordPress Loop using pre_get_posts.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



function custom_loop_pre_get_posts( $query ) {

	if ( ! is_admin() && $query->is_main_query() ) {

		$query->set( 'posts_per_page', 1 );

	}

}
add_action( 'pre_get_posts', 'custom_loop_pre_get_posts' );


