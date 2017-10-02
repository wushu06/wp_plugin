<?php
/*
Plugin Name: Enqueue on Public Pages
Description: Examples showing how to enqueue JavaScript and CSS on public-facing pages.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// enqueue public style
function myplugin_enqueue_style_public() {

	/*
		wp_enqueue_style(
			string           $handle,
			string           $src = '',
			array            $deps = array(),
			string|bool|null $ver = false,
			string           $media = 'all'
		)
	*/

	$src = plugin_dir_url( __FILE__ ) .'public/css/example-public.css';

	wp_enqueue_style( 'myplugin-public', $src, array(), null, 'all' );

}
add_action( 'wp_enqueue_scripts', 'myplugin_enqueue_style_public' );





// enqueue public script
function myplugin_enqueue_script_public() {

	/*
		wp_enqueue_script(
			string           $handle,
			string           $src = '',
			array            $deps = array(),
			string|bool|null $ver = false,
			bool             $in_footer = false
		)
	*/

	$src = plugin_dir_url( __FILE__ ) .'public/js/example-public.js';

	wp_enqueue_script( 'myplugin-public', $src, array(), null, false );

}
add_action( 'wp_enqueue_scripts', 'myplugin_enqueue_script_public' );




