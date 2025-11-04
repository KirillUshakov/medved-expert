<?php
	//avoid direct calls to this file where wp core files not present
	if( ! function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}

	class WT_Likes {

		private static $instance = null;

		public $pagehook;

		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __construct() {
			//Register meta boxes of editing post
			//add_action( 'add_meta_boxes', array( &$this, 'register_meta_boxes' ) );
			//Save custom data of post
			//add_action( 'save_post', array( &$this, 'save_meta_boxes' ) );
			//Prepare screen for likes settings page
			//add_filter( 'screen_layout_columns', array( &$this, 'on_screen_layout_columns' ), 10, 2 );
			//Call functions to add likes settings page
			//add_action( 'admin_menu', array( &$this, 'on_admin_menu' ) );
			//Ajax function for like or unlike post
			add_action( 'wp_ajax_wt_like', array( &$this, 'like' ) );
			add_action( 'wp_ajax_nopriv_wt_like', array( &$this, 'like' ) );
			//Register script for like or unlike post
			add_action( 'wp_enqueue_scripts', array( &$this, 'register_js' ) );
		}

		function register_meta_boxes() {

		}

		function save_meta_boxes( $post_id ) {

		}

		function on_screen_layout_columns( $columns, $screen ) {
			if( $screen == $this->pagehook ) {
				$columns[$this->pagehook] = 2;
			}

			return $columns;
		}

		function on_admin_menu() {
			$this->pagehook = add_options_page( _x( 'Likes', 'Title of settings page', 'walnut' ), _x( 'Likes', 'Name of options page', 'walnut' ), 'manage_options', //Возможность пользователя необходимая, чтобы он увидел эту страницу меню
				'likes', //Идентификатор меню (slug), по которому можно обращаться к меню. Должен быть уникальным
				array( &$this, 'on_show_likes_page' ) //Callback функция, выводящая HTML код страницы пункта меню
			);
			add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_likes_page' ) );
			add_action( 'admin_print_scripts-' . $this->pagehook, array( &$this, 'register_admin_scripts' ) );
		}

		function on_load_likes_page() {
			add_meta_box( 'main', _x( 'Main options', 'Title for meta box', 'walnut' ), array(
				&$this,
				'add_meta_box_settings_main'
			), $this->pagehook, 'normal', 'high' );
		}

		public function register_admin_scripts() {
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
		}

		function on_show_likes_page() {
			if( isset( $_POST['submit'] ) ) {
				$this->save_likes_settings();
			}
			require_once get_template_directory() . '/core/tmpl/admin/likes_settings.php';
		}

		private function save_likes_settings() {
			if( $_POST['post_types'] ) {
				update_option( 'likes_settings_main_post_types', $_POST['post_types'] );
			}
		}

		public function add_meta_box_settings_main() {
			wp_nonce_field( 'wt_likes', 'wt_likes' );
			if( ! $saved = get_option( 'likes_settings_main_post_types' ) ) {
				$saved = array();
			}
			$post_types = get_post_types( array(), 'objects' );
			foreach( $post_types as $i => $post_type ) {
				if( in_array( $post_type->name, array( 'attachment', 'revision', 'nav_menu_item' ) ) ) {
					unset( $post_types[$i] );
				}
			}
			include get_template_directory() . '/core/tmpl/metaboxes/wt_likes/main.php';
		}

		public function link( $text_before = '', $text_after = '', $post_id = null ) {
			/*$text_before = sanitize_text_field( $text_before );
			$text_after = sanitize_text_field( $text_after );*/
			$post_id = (int)$post_id;
			$likes = get_post_meta( $post_id, '_wt_likes' );
			$likes = isset( $likes[0] ) ? $likes[0] : $likes;
			$like = $this->get_like( $post_id );
			if( $like ) {
				$key = in_array( $like, $likes );
			}
			if( isset( $key ) && isset( $like ) && is_array( $likes ) && in_array( $like, $likes ) ) {
				$liked = true;
			} else {
				$liked = false;
			}
			include get_template_directory() . '/core/tmpl/inc/like.php';
		}

		public function like() {
			if( ! check_ajax_referer( 'bet-wt_like', 'nonce' ) ) {
				wp_send_json_error( _x( 'Wrong form nonce code. Betting like is impossible', 'Ajax error message', 'walnut' ) );
				wp_die();
			} else {
				if( isset( $_POST['id'] ) ) {
					$post_id = (int)$_POST['id'];
				}
			}
			if( ! isset( $post_id ) || ! $post_id ) {
				wp_send_json_error( _x( 'Wrong ID. Betting like is impossible', 'Ajax error message', 'walnut' ) );
				wp_die();
			} else {
				$likes = get_post_meta( $post_id, '_wt_likes' );
				$likes = isset( $likes[0] ) ? $likes[0] : $likes;
				$like = $this->get_like( $post_id );
				if( $like ) {
					$key = array_search( $like, $likes );
				}
				if( isset( $key ) && is_array( $likes ) && ! empty( $likes ) && isset( $likes[$key] ) ) {
					setcookie( 'wt_like-post-' . $post_id, '', time() - 3600, '/', $_SERVER['HTTP_HOST'] );
					unset( $likes[$key] );
					$data['type'] = 'unlike';
				} else {
					setcookie( 'wt_like-post-' . $post_id, WT_Session::instance()->id, time() + 60 * 60 * 24 * 365 * 10, '/', $_SERVER['HTTP_HOST'] );
					$likes[] = WT_Session::instance()->id;
					$data['type'] = 'like';
				}
				update_post_meta( $post_id, '_wt_likes', $likes );
				$data['success'] = _x( 'Like or unlike successful', 'Ajax success message', 'walnut' );
				wp_send_json_success( $data );
				wp_die();
			}
		}

		public function get_like( $post_id ) {
			if( isset( $_COOKIE['wt_like-post-' . $post_id] ) ) {
				return $_COOKIE['wt_like-post-' . $post_id];
			}

			return null;
		}

		public function get_count( $post_id ) {
			$likes = get_post_meta( $post_id, '_wt_likes' );
			$likes = isset( $likes[0] ) ? $likes[0] : $likes;

			return count( $likes );
		}

		function register_js() {
			wp_register_script( 'like.js', get_template_directory_uri() . '/core/tmpl/js/like.js', array( 'jquery' ), true );
			wp_enqueue_script( 'like.js' );
			wp_localize_script( 'like.js', 'dataLikes', array(
				'url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'bet-wt_like' )
			) );
		}
	}