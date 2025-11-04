<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Update {
		
		private $url = 'https://wptheme.walnut.team/';
		private $version;
		private $base;
		
		public function __construct() {
			//TEMP: Enable update check on every request. Normally you don't need this! This is for testing only!
			//set_site_transient( 'update_themes', null );
			
			$theme_data = wp_get_theme( get_option( 'template' ) );
			$this->version = $theme_data->Version;
			$this->base = get_option( 'template' );
			
			//Check updates
			add_filter( 'pre_set_site_transient_update_themes', array( &$this, 'check_for_update' ) );
			
			//Take over the Theme info screen on WP multisite
			add_filter( 'themes_api', array( &$this, 'theme_api_call' ), 10, 3 );
			
			//Set transient update_themes
			if( is_admin() ) {
				$current = get_transient( 'update_themes' );
			}
		}
		
		public function check_for_update( $checked_data ) {
			global $wp_version;
			
			$request = array(
				'slug' => $this->base, 'version' => $this->version
			);
			
			// Start checking for an update
			$send_for_check = array(
				'body'          => array(
					'action'  => 'theme_update', 'request' => serialize( $request ),
					'api-key' => md5( esc_url( home_url() ) )
				), 'user-agent' => 'WordPress/' . $wp_version . '; ' . esc_url( home_url() )
			);
			
			$raw_response = wp_remote_post( $this->url, $send_for_check );
			
			$response = array();
			if( !is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) ) {
				$response = unserialize( $raw_response['body'] );
			}
			if( !empty( $response ) ) {
				$checked_data->response[ $this->base ] = $response;
			}
			
			return $checked_data;
		}
		
		function my_theme_api_call( $def, $action, $args ) {
			if( $args->slug != $this->base ) {
				return false;
			}
			
			// Get the current version
			$args->version = $this->version;
			$request_string = prepare_request( $action, $args );
			$request = wp_remote_post( $this->url, $request_string );
			if( is_wp_error( $request ) ) {
				$res = new WP_Error( 'themes_api_failed',
					__( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ),
					$request->get_error_message() );
			} else {
				$res = unserialize( $request['body'] );
				
				if( $res === false ) {
					$res = new WP_Error( 'themes_api_failed', __( 'An unknown error occurred' ), $request['body'] );
				}
			}
			
			return $res;
		}
		
	}
	