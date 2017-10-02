<?php // MyPlugin - Settings Callbacks



// disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



// callback: validate options
function myplugin_callback_validate_options( $input ) {

	// todo: add callback functionality..

	return $input;

}



// callback: login section
function myplugin_callback_section_login() {

	echo '<p>These settings enable you to customize the WP Login screen.</p>';

}



// callback: admin section
function myplugin_callback_section_admin() {

	echo '<p>These settings enable you to customize the WP Admin Area.</p>';

}



// callback: text field
function myplugin_callback_field_text( $args ) {

	// todo: add callback functionality..

	echo 'This will be a text field.';

}



// callback: radio field
function myplugin_callback_field_radio( $args ) {

	// todo: add callback functionality..

	echo 'This will be a radio field.';

}



// callback: textarea field
function myplugin_callback_field_textarea( $args ) {

	// todo: add callback functionality..

	echo 'This will be a textarea.';

}



// callback: checkbox field
function myplugin_callback_field_checkbox( $args ) {

	// todo: add callback functionality..

	echo 'This will be a checkbox.';

}



// callback: select field
function myplugin_callback_field_select( $args ) {

	// todo: add callback functionality..

	echo 'This will be a select menu.';

}


