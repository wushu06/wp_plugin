<?php
/*
Plugin Name: Deactivation & Activation
Description: Example demonstrating activation, deactivation, and uninstall hooks.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// do stuff on activation
function myplugin_on_activation() {
    // if the current use does not have sufficiant preivlage the function will simply retuen without doing anything

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	add_option( 'myplugin_posts_per_page', 10 );
	add_option( 'myplugin_show_welcome_page', true );

}
register_activation_hook( __FILE__, 'myplugin_on_activation' );





// do stuff on deactivation
function myplugin_on_deactivation() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;

	flush_rewrite_rules();

}
register_deactivation_hook( __FILE__, 'myplugin_on_deactivation' );





// do stuff on uninstall
function myplugin_on_uninstall() {

	if ( ! current_user_can( 'activate_plugins' ) ) return;
// delete from db
	delete_option( 'myplugin_posts_per_page', 10 );
	delete_option( 'myplugin_show_welcome_page', true );

}
register_uninstall_hook( __FILE__, 'myplugin_on_uninstall' );




