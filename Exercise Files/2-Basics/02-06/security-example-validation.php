<?php
/*
Plugin Name: Security Example: Data Validation
Description: Example demonstrating data validation.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// validate phone number
function myplugin_is_phone_number( $phone_number ) {

	// check if empty
	if ( empty( $phone_number ) ) return false;

	// check format
	if ( ! preg_match( "/^\(?([0-9]{3})\)?([ .-]?)([0-9]{3})([ .-]?)([0-9]{4})$/", $phone_number ) ) return false;

	// all good!
	return true;

}



// display form
function myplugin_form_phone_number() {

	?>

	<form method="post">
		<p><label for="phone">Please enter your phone number:</label></p>
		<p><input id="phone" type="tel" name="myplugin-phone-number"></p>
		<p><input type="submit" value="Submit Form"></p>
	</form>

<?php

}



// process submitted form
function myplugin_process_phone_number() {

	if ( isset( $_POST[ 'myplugin-phone-number' ] ) ) {

		$phone_number = $_POST[ 'myplugin-phone-number' ];

		if ( myplugin_is_phone_number( $phone_number ) ) {

			echo '<p>Thank you for your phone number!</p>';

		} else {

			echo '<p>Please provide a valid phone number!</p>';

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
function security_example_validation_add_toplevel_menu() {

	add_menu_page(
		'Security Example: Data Validation',
		'Data Validation',
		'manage_options',
		'security-example-validation',
		'security_example_validation_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'security_example_validation_add_toplevel_menu' );



// display the plugin settings page
function security_example_validation_display_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<?php myplugin_form_phone_number(); ?>
		<?php myplugin_process_phone_number(); ?>

	</div>

<?php

}


