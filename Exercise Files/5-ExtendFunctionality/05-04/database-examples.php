<?php
/*
Plugin Name: Database Examples
Description: Examples demonstrating how to query the WordPress database.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/



// Example 1: select a variable
function database_examples_get_user_count() {

	global $wpdb;

	$query = "SELECT COUNT( * ) FROM $wpdb->users";

	$results = $wpdb->get_var( $query );


	// display the results

	if ( null !== $results ) {

		echo '<div>Number of users: '. $results .'</div>';

	} else {

		echo '<div>No results.</div>';

	}

}



// Example 2: select a variable
function database_examples_sum_custom_fields() {

	global $wpdb;

	$meta_key = 'minutes';

	$query = "SELECT sum( meta_value ) FROM $wpdb->postmeta WHERE meta_key = %s";

	$prepared_query = $wpdb->prepare( $query, $meta_key );

	$results = $wpdb->get_var( $prepared_query );


	// display the results

	if ( null !== $results ) {

		echo '<div>Total minutes: '. $results .'</div>';

	} else {

		echo '<div>No results.</div>';

	}

}



// Example 3: select a row
function database_examples_get_primary_admin() {

	global $wpdb;

	$user_id = 1;

	$query = "SELECT * FROM $wpdb->users WHERE ID = %d";

	$prepared_query = $wpdb->prepare( $query, $user_id );

	$user = $wpdb->get_row( $prepared_query );


	// display the results

	if ( null !== $user ) {

		echo '<div>Primary Admin User:</div>';
		echo '<pre>';
		var_dump( $user );
		echo '</pre>';

		echo '<div>User ID: '. $user->ID .'</div>';
		echo '<div>User Login: '. $user->user_login .'</div>';
		echo '<div>User Email: '. $user->user_email .'</div>';

	} else {

		echo '<div>No results.</div>';

	}

}



// Example 4: select a column
function database_examples_get_all_user_ids() {

	global $wpdb;

	$query = "SELECT ID FROM $wpdb->users";

	$results = $wpdb->get_col( $query );


	// display the results

	if ( null !== $results ) {

		echo '<div>All user IDs:</div>';
		echo '<pre>';
		var_dump( $results );
		echo '</pre>';

	} else {

		echo '<div>No results.</div>';

	}

}



// Example 5: select generic results
function database_examples_get_draft_posts() {

	global $wpdb;

	$post_author = 1;

	$query = "SELECT ID, post_title
				FROM $wpdb->posts
				WHERE post_status = 'draft'
				AND post_type = 'post'
				AND post_author = %s";

	$prepared_query = $wpdb->prepare( $query, $post_author );

	$draft_posts = $wpdb->get_results( $prepared_query );


	// display the results

	if ( null !== $draft_posts ) {

		echo '<div>All draft posts:</div>';
		echo '<pre>';
		var_dump( $draft_posts );
		echo '</pre>';

		echo '<p>Draft post titles:</p>';

		foreach ( $draft_posts as $draft_post) {

			echo '<div>'. $draft_post->post_title .'</div>';

		}

	} else {

		echo '<div>No results.</div>';

	}

}



// Example 6: running general queries
function database_examples_add_custom_field() {

	global $wpdb;

	$post_id = 1;

	$meta_key = 'favorite-season';

	$meta_value = 'Autumn';

	$query = "INSERT INTO $wpdb->postmeta( post_id, meta_key, meta_value )
						VALUES ( %d, %s, %s )";

	$prepared_query = $wpdb->prepare( $query, $post_id, $meta_key, $meta_value );

	$result = $wpdb->query( $prepared_query );


	// display the results

	echo '<div>Add custom field: ';

	if ( false === $result ) echo 'There was an error.';

	elseif ( 0 === $result ) echo 'No results.';

	else echo 'The custom field was added.';

	echo '</div>';

}










/*
	
	Ignore code below this line..
	It's used to create the plugin page
	See 3.02 - Adding administrative menus
	
*/

// add top-level administrative menu
function database_examples_add_toplevel_menu() {

	add_menu_page(
		esc_html__('Database Examples', 'myplugin'),
		esc_html__('Database Examples', 'myplugin'),
		'manage_options',
		'database_examples',
		'database_examples_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'database_examples_add_toplevel_menu' );



// display the plugin settings page
function database_examples_display_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<div class="wrap">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<p><?php esc_html_e( 'This plugin demo shows ways to query the database.', 'myplugin' ); ?></p>

		<h2><?php esc_html_e( 'Select a variable', 'myplugin' ); ?></h2>
		<?php database_examples_get_user_count(); ?>
		<?php database_examples_sum_custom_fields(); ?>

		<h2><?php esc_html_e( 'Select a row', 'myplugin' ); ?></h2>
		<?php database_examples_get_primary_admin(); ?>

		<h2><?php esc_html_e( 'Select a column', 'myplugin' ); ?></h2>
		<?php database_examples_get_all_user_ids(); ?>

		<h2><?php esc_html_e( 'Select generic results', 'myplugin' ); ?></h2>
		<?php database_examples_get_draft_posts(); ?>

		<h2><?php esc_html_e( 'Run general queries', 'myplugin' ); ?></h2>
		<?php database_examples_add_custom_field(); ?>
		<?php database_examples_delete_custom_field(); ?>

	</div>

<?php

}


