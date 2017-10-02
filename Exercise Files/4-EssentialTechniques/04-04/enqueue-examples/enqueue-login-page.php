<?php
/*
Plugin Name: Enqueue on Login Page
Description: Examples showing how to enqueue JavaScript and CSS on the Login Page.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// enqueue login style
function myplugin_enqueue_style_login() {

	$src = plugin_dir_url( __FILE__ ) .'admin/css/example-admin.css';

	wp_enqueue_style( 'myplugin-login', $src, array(), null, 'all' );

}
add_action( 'login_enqueue_scripts', 'myplugin_enqueue_style_login' );





// enqueue login script
function myplugin_enqueue_script_login() {

	$src = plugin_dir_url( __FILE__ ) .'admin/js/example-admin.js';

	wp_enqueue_script( 'myplugin-login', $src, array(), null, false );

}
add_action( 'login_enqueue_scripts', 'myplugin_enqueue_script_login' );




