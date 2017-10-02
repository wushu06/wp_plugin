<?php
/*
Plugin Name: REST API: Create Posts
Description: Example demonstrating how to use the REST API to create new posts.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// enqueue scripts
function restapi_enqueue_scripts( $hook ) {

	// define script url
	$script_url = plugins_url( '/rest-create-posts.js', __FILE__ );

	// check if user can publish posts
	if ( current_user_can( 'publish_posts') ) {

		// enqueue script
		wp_enqueue_script( 'rest-create-posts', $script_url, array(), null, true );

		// add inline script
		wp_localize_script(
			'rest-create-posts',
			'rest_create_posts',
			array(
				'root'    => esc_url_raw( rest_url() ),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
				'success' => __( 'Success! Post created.' ),
				'failure' => __( 'Failure! Post not created.' )
			)
		);

	}

}
add_action( 'wp_enqueue_scripts', 'restapi_enqueue_scripts' );



// shortcode: [restapi_markup]
function restapi_markup() {

	$html = '';

	if ( current_user_can( 'publish_posts') ) {

		$html .= '<style>.rest-create-post p { margin: 5px 0; }</style>';
		$html .= '<form class="rest-create-post">';
		$html .= '<div class="rest-post-result"></div>';
		$html .= '<p>Create a new post using the REST API.</p>';
		$html .= '<p><input type="text" name="title" placeholder="Title"></p>';
		$html .= '<p><textarea name="content" placeholder="Content"></textarea></p>';
		$html .= '<input type="submit" id="rest-create-post" value="Create Post">';
		$html .= '</form>';

	}

	return $html;

}
add_shortcode( 'restapi_markup', 'restapi_markup' );



// execute shortcode in widgets
add_filter('widget_text', 'do_shortcode', 10);


