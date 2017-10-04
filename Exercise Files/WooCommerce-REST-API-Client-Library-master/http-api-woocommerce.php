<?php
/*
Plugin Name: HTTP API: woocommerce
Description: Example demonstrating how to use the HTTP API to make a GET request.
Plugin URI:  https://plugin-planet.com/
Author:      Jeff Starr
Version:     1.0
*/
/* ============================================================================================================ Catching the data */
function grab_data(){
	require_once( 'lib/woocommerce-api.php' );
	
	$options = array(
		'debug'           => true,
		'return_as_array' => false,
		'validate_url'    => false,
		'timeout'         => 30,
		'ssl_verify'      => false,
	);
	
	try {
	
		$client = new WC_API_Client( 'http://www.swimbabeslessons.co.uk/', 'ck_a985b311983849f500a25fe38db4f60d2b3bce56', 'cs_dbd37bf68ec428c939cb91e4e35794f56332ac29', $options );
	
	 //print_r( $client->products->get() );
	 //print_r( $client->products->get( 219));
	 //print_r( $client->products->get_categories() );
	 //echo $client->products['title'];
	 
	 $json = $client->products->get(  );
	 $title =  '<h1>'.$json->products[0]->title.'</h1>';
	 if ( false === ( $title = get_transient( 'myplugin_wp_query' ) ) ) {
		// set transient to cache results for 12 hours
			set_transient( 'myplugin_wp_query', $title, 12 * HOUR_IN_SECONDS );

		}
	 
	 echo $title;

	 echo '<p><strong> Stock: ' .$json->products[0]->stock_quantity.'</strong> </p><br>';
	 echo '<a href="'.$json->products[0]->permalink.'">See Page</a><br>';
	 echo '<img src="'.$json->products[0]->images[0]->src.'">';
	 echo '<pre>';
	var_dump($json->products);
	echo '</pre>';
	/*foreach ($json as  $key ) { // This will search in the 2 jsons
	//echo $key->title;
	echo '<pre>';
	//var_dump($key);
	echo '</pre>';	
		 
   }*/
  
	
	
	} catch ( WC_API_Client_Exception $e ) {
	
		echo $e->getMessage() . PHP_EOL;
		echo $e->getCode() . PHP_EOL;
	
		if ( $e instanceof WC_API_Client_HTTP_Exception ) {
	
			print_r( $e->get_request() );
			print_r( $e->get_response() );
		}
	}
	}



/*

	Ignore code below this line..
	It's used to create the plugin page
	See 3.02 - Adding administrative menus

*/
/* ============================================================================================================ Menu / page where data will be showed */
// add top-level administrative menu
function http_woo_add_toplevel_menu() {

	add_menu_page(
		'HTTP API: GET woocommerce',
		'HTTP API: GET woocommerce',
		'manage_options',
		'http_get',
		'http_woo_display_settings_page',
		'dashicons-admin-generic',
		null
	);

}
add_action( 'admin_menu', 'http_woo_add_toplevel_menu' );



// display the plugin settings page
function http_woo_display_settings_page() {

	// check if user is allowed access
	if ( ! current_user_can( 'manage_options' ) ) return;

	?>

	<style>
		pre {
			width: 95%; overflow: auto; margin: 20px 0; padding: 20px;
			color: #fff; background-color: #424242;
		}
	</style>

	<div class="wrap">

		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<?php grab_data(); ?>

	</div>

<?php

}








/* ============================================================================================================ Caching the page */
	
		// check if transient exists
	
	
	
	
	// delete transient on plugin deactivation
	function custom_loop_wp_query_on_deactivation() {
	
		if ( ! current_user_can( 'activate_plugins' ) ) return;
	
		delete_transient( 'myplugin_wp_query' );
	
	}
	register_deactivation_hook( __FILE__, 'custom_loop_wp_query_on_deactivation' );
