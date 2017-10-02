<?php // example: conditional loading

if ( is_admin() ) {

  require_once( dir_name( __FILE__ ) . '/admin/do-stuff.php' );

}


