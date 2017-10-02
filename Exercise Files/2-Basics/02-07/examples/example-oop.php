<?php // example: OOP

if ( ! class_exists( 'Example_Plugin' ) ) {

	class Example_Plugin {

		public static function init() {
			// do stuff..
		}
		public static function register() {
			// do stuff..
		}
		public static function modify() {
			// do stuff..
		}

	}

	Example_Plugin::init();
	Example_Plugin::register();
	Example_Plugin::modify();

}


