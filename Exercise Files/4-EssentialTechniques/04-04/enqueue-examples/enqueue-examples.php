<?php
/*
Plugin Name: Enqueue Examples
Description: More examples of JavaScript and CSS enqueue functions.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// enqueue admin style on specific page
function myplugin_enqueue_style_admin_page( $hook ) {

	// wp_die( $hook );

	if ( 'settings_page_dashboard_widgets_suite' === $hook ) {

		$src = plugin_dir_url( __FILE__ ) .'admin/css/example-admin.css';

		wp_enqueue_style( 'myplugin-admin-page', $src, array(), null, 'all' );

	}

}
add_action( 'admin_enqueue_scripts', 'myplugin_enqueue_style_admin_page' );





// enqueue admin style on specific page type
function myplugin_enqueue_style_admin_pages( $hook ) {

	// wp_die( $hook );

	if ( 'edit.php' === $hook ) {

		$src = plugin_dir_url( __FILE__ ) .'admin/css/example-admin.css';

		wp_enqueue_style( 'myplugin-admin-pages', $src, array(), null, 'all' );

	}

}
add_action( 'admin_enqueue_scripts', 'myplugin_enqueue_style_admin_pages' );





// dependency example: admin
function myplugin_enqueue_jquery_admin( $hook ) {

	// wp_die( $hook );

	$src = plugin_dir_url( __FILE__ ) .'admin/js/example-admin.js';

	wp_enqueue_script( 'myplugin-admin', $src, array( 'jquery' ), '1.0' );

}
add_action( 'admin_enqueue_scripts', 'myplugin_enqueue_jquery_admin' );





// dependency example: public
function myplugin_enqueue_jquery_public() {

	$src = plugin_dir_url( __FILE__ ) .'public/js/example-public.js';

	wp_enqueue_script( 'myplugin-public', $src, array( 'jquery' ), '1.0' );

}
add_action( 'wp_enqueue_scripts', 'myplugin_enqueue_jquery_public' );




