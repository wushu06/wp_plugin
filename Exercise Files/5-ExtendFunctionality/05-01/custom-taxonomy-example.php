<?php
/*
Plugin Name: Custom Taxonomy Example
Description: Example demonstrating how to add a Custom Taxonomy via plugin.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// add custom taxonomy
function myplugin_add_custom_taxonomy() {

	/*

		register_taxonomy(
			string       $taxonomy,
			array|string $object_type,
			array|string $args = array()
		)

		For a list of $args, check out:
		https://developer.wordpress.org/reference/functions/register_taxonomy/

	*/

	$args = array(
		'labels'            => array( 'name' => 'Art' ),
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
	);

	register_taxonomy( 'art', 'post', $args );

}
add_action( 'init', 'myplugin_add_custom_taxonomy' );


