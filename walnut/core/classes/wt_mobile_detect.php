<?php
	//avoid direct calls to this file where wp core files not present
	if( ! function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	get_template_part( 'core/libraries/mobile_detect' );
	
	class WT_Mobile_Detect {
		
		private static $instance = null;
		
		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new Mobile_Detect();
			}
			
			return self::$instance;
		}
		
		private function __construct() { }
	}