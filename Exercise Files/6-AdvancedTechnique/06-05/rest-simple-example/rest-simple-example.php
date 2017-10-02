<?php
/*
Plugin Name: REST API: Simple Example
Description: Simple example demonstrating how to use the REST API.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// add top-level administrative menu
function rest_example_add_toplevel_menu() {

	add_menu_page(
		'REST API: Simple Example',
		'REST API: Simple Example',
		'manage_options',
		'rest-example',
		'rest_example_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'rest_example_add_toplevel_menu' );



// display the plugin settings page
function rest_example_display_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p>
			<?php _e( 'This plugin demonstrates how to use the REST API.' ); ?>
			<?php _e( 'Click the button to display the special message.' ); ?>
		</p>

		<input id="rest-button" class="button button-primary" type="submit" value="Get Special Message">
		<div id="rest-response"></div>

	</div>

<?php

}



// enqueue scripts
function rest_example_enqueue_scripts( $hook ) {

	// check if our page
	if ( 'toplevel_page_rest-example' !== $hook ) return;

	// define rest url
	$url = wp_json_encode( esc_url_raw( rest_url( 'example/v1/test' ) ) );

	// define script
	$script = '
		jQuery(document).ready(function($){

			$("#rest-button").on("click",function(){

				$.ajax({

					url: '. $url .'

				}).done(function(data){

					$("#rest-response").append(data);

				});

			});

		});';

	// add inline script (WP >= 4.5)
	wp_add_inline_script( 'jquery-core', $script );

}
add_action( 'admin_enqueue_scripts', 'rest_example_enqueue_scripts' );



// register rest route
function rest_example_register_route() {

	/*
		register_rest_route(
			string $namespace,
			string $route,
			array  $args = array(),
			bool   $override = false
		)
	*/

	register_rest_route(
		'example/v1',
		'/test',
		array(
			'methods'  => 'GET',
			'callback' => 'rest_example_special_message'
		)
	);

}
add_action( 'rest_api_init', 'rest_example_register_route' );



// callback function
function rest_example_special_message() {

	return '<p>This is the special message!</p>';

}


