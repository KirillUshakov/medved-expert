<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Session {
		
		private static $instance = null;
		
		public $id = null;
		public $lifetime = 300;
		
		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		private function __construct() {
			if( !session_id() ) {
				ini_set( 'session.gc_maxlifetime', $this->lifetime );
				ini_set( 'session.cookie_lifetime', $this->lifetime );
				session_save_path( '/tmp/' );
				session_start();
			}
			
			$this->id = session_id();
			session_write_close();
		}
		
		function destroy() {
			if( session_id() ) {
				setcookie( session_name(), session_id(), time() - 60 * 60 * 24 );
				session_unset();
				session_destroy();
			}
		}
	}