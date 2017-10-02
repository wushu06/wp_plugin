<?php
/*
Plugin Name: Security Example: Nonces
Description: Example demonstrating nonce security.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// display form
function myplugin_form_favorite_music() {

	?>

	<form method="post">
		<p><label for="music">What is your favorite music?</label></p>
		<p><input id="music" type="text" name="myplugin-favorite-music"></p>
		<p><input type="submit" value="Submit Form"></p>

		<?php wp_nonce_field( 'myplugin_form_action', 'myplugin_nonce_field', false ); ?>

	</form>

<?php

}



// process submitted form
function myplugin_process_favorite_music() {

	// get the nonce
	if ( isset( $_POST['myplugin_nonce_field'] ) ) {

		$nonce = $_POST['myplugin_nonce_field'];

	} else {

		$nonce = false;

	}

	// process form
	if ( isset( $_POST['myplugin-favorite-music'] ) ) {

		// verify nonce
		if ( ! wp_verify_nonce( $nonce, 'myplugin_form_action' ) ) {

			wp_die( 'Incorrect nonce!' );

		} else {

			$fav_music = sanitize_text_field( $_POST[ 'myplugin-favorite-music' ] );

			if ( ! empty( $fav_music ) ) {

				echo '<p>Your favorite music is '. $fav_music .'.</p>';

			} else {

				echo '<p>Please enter your favorite music!</p>';

			}

		}

	}

}










/*

	Adding the plugin menu and settings page
	Below this line covered later in the course
	See video: 3.02 - Adding administrative menus
	Ignore this stuff for now..

*/

// add top-level administrative menu
function security_example_nonces_add_toplevel_menu() {

	add_menu_page(
		'Security Example: Nonces',
		'Nonce Security',
		'manage_options',
		'security-example-nonces',
		'security_example_nonces_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'security_example_nonces_add_toplevel_menu' );



// display the plugin settings page
function security_example_nonces_display_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<?php myplugin_form_favorite_music(); ?>
		<?php myplugin_process_favorite_music(); ?>

	</div>

<?php

}


