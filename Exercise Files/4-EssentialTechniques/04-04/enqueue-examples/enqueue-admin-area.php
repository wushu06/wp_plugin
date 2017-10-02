<?php
/*
Plugin Name: Enqueue in Admin Area
Description: Examples showing how to enqueue JavaScript and CSS in the Admin Area.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// enqueue admin style
function myplugin_enqueue_style_admin() {
	
	/*
		wp_enqueue_style(
			string           $handle,
			string           $src = '',
			array            $deps = array(),
			string|bool|null $ver = false,
			string           $media = 'all'
		)
	*/
	
	$src = plugin_dir_url( __FILE__ ) .'admin/css/example-admin.css';

	wp_enqueue_style( 'myplugin-admin', $src, array(), null, 'all' );

}
add_action( 'admin_enqueue_scripts', 'myplugin_enqueue_style_admin' );





// enqueue admin script
function myplugin_enqueue_script_admin() {
	
	/*
		wp_enqueue_script(
			string           $handle,
			string           $src = '',
			array            $deps = array(),
			string|bool|null $ver = false,
			bool             $in_footer = false
		)
	*/
	
	$src = plugin_dir_url( __FILE__ ) .'admin/js/example-admin.js';

	wp_enqueue_script( 'myplugin-admin', $src, array(), null, false );

}
add_action( 'admin_enqueue_scripts', 'myplugin_enqueue_script_admin' );




