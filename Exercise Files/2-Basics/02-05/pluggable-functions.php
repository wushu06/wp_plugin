<?php
/*
Plugin Name: Pluggable Functions
Description: Basic example demonstrating pluggable functions.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// pluggable function
function wp_logout() {
	wp_destroy_current_session();
	wp_clear_auth_cookie();

	myplugin_custom_logout();

	/**
	 * Fires after a user is logged-out.
	 *
	 * @since 1.5.0
	 */
	do_action( 'wp_logout' );
}



// customize logout function
function myplugin_custom_logout() {

	// do something when the user logs out..

}
// add_action( 'wp_logout', 'myplugin_custom_logout' );


