<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Ratings {
		
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
			//Prepare screen for ratings settings page
			//add_filter( 'screen_layout_columns', array( &$this, 'on_screen_layout_columns' ), 10, 2 );
			//Call functions to add ratings settings page
			//add_action( 'admin_menu', array( &$this, 'on_admin_menu' ) );
			//Ajax function for rating post
			add_action( 'wp_ajax_wt_rating', array( &$this, 'rating' ) );
			add_action( 'wp_ajax_nopriv_wt_rating', array( &$this, 'rating' ) );
			//Register script for rating post
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
			$this->pagehook = add_options_page( _x( 'Ratings', 'Title of settings page', 'walnut' ),
				_x( 'Ratings', 'Name of options page', 'walnut' ), 'manage_options',
				//Возможность пользователя необходимая, чтобы он увидел эту страницу меню
				'ratings', //Идентификатор меню (slug), по которому можно обращаться к меню. Должен быть уникальным
				array( &$this, 'on_show_ratings_page' ) //Callback функция, выводящая HTML код страницы пункта меню
			);
			add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_ratings_page' ) );
			add_action( 'admin_print_scripts-' . $this->pagehook, array( &$this, 'register_admin_scripts' ) );
		}
		
		function on_load_ratings_page() {
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
		
		function on_show_ratings_page() {
			if( isset( $_POST['submit'] ) ) {
				$this->save_ratings_settings();
			}
			require_once get_template_directory() . '/core/tmpl/admin/ratings_settings.php';
		}
		
		private function save_ratings_settings() {
			if( $_POST['post_types'] ) {
				update_option( 'ratings_settings_main_post_types', $_POST['post_types'] );
			}
		}
		
		public function add_meta_box_settings_main() {
			wp_nonce_field( 'wt_ratings', 'wt_ratings' );
			if( !$saved = get_option( 'ratings_settings_main_post_types' ) ) {
				$saved = array();
			}
			$post_types = get_post_types( array(), 'objects' );
			foreach( $post_types as $i => $post_type ) {
				if( in_array( $post_type->name, array( 'attachment', 'revision', 'nav_menu_item' ) ) ) {
					unset( $post_types[$i] );
				}
			}
			include get_template_directory() . '/core/tmpl/metaboxes/wt_ratings/main.php';
		}
		
		public function rating_block( $disable = false, $post_id = null ) {
			$rating = $this->calc_rating( $post_id );
			$rating_average = $rating['average'];
			$rating_count = $rating['count'];
			if( isset( $_COOKIE['wt_rating-post-' . $post_id] ) ) {
				$rating = explode( '-', $_COOKIE['wt_rating-post-' . $post_id] );
				$rating = $rating[1];
			} else {
				$rating = 0;
			}
			include get_template_directory() . '/core/tmpl/inc/rating.php';
		}
		
		public function rating() {
			if( !check_ajax_referer( 'put-wt_star', 'nonce' ) ) {
				wp_send_json_error( _x( 'Wrong form nonce code. Rating is impossible', 'Ajax error message',
					'walnut' ) );
				wp_die();
			}
			if( isset( $_POST['id'] ) ) {
				$post_id = (int)$_POST['id'];
			}
			if( !isset( $post_id ) || !$post_id ) {
				wp_send_json_error( _x( 'Wrong ID. Rating is impossible', 'Ajax error message', 'walnut' ) );
				wp_die();
			} else {
				if( isset( $_POST['star'] ) ) {
					$star = (int)$_POST['star'];
				}
			}
			if( !isset( $star ) || !$star || $star < 0 || $star > 5 ) {
				wp_send_json_error( _x( 'Wrong star. Rating is impossible', 'Ajax error message', 'walnut' ) );
				wp_die();
			} else {
				$ratings = get_post_meta( $post_id, '_wt_ratings' );
				$ratings = isset( $ratings[0] ) ? $ratings[0] : $ratings;
				if( isset( $_COOKIE['wt_rating-post-' . $post_id] ) ) {
					$rating = $_COOKIE['wt_rating-post-' . $post_id];
				}
				if( isset( $rating ) ) {
					$is_put = false;
					setcookie( 'wt_rating-post-' . $post_id, WT_Session::instance()->id . '-' . $star,
						time() + 60 * 60 * 24 * 365 * 10, '/', $_SERVER['HTTP_HOST'] );
					foreach( $ratings as $key => $value ) {
						if( $value == $rating ) {
							$ratings[$key] = WT_Session::instance()->id . '-' . $star;
							$is_put = true;
							break;
						}
					}
					if( !$is_put ) {
						$ratings[] = WT_Session::instance()->id . '-' . $star;
					}
				} else {
					setcookie( 'wt_rating-post-' . $post_id, WT_Session::instance()->id . '-' . $star,
						time() + 60 * 60 * 24 * 365 * 10, '/', $_SERVER['HTTP_HOST'] );
					$ratings[] = WT_Session::instance()->id . '-' . $star;
				}
				update_post_meta( $post_id, '_wt_ratings', $ratings );
				$rating = $this->calc_rating( $post_id );
				$rating_average = $rating['average'];
				update_post_meta( $post_id, '_wt_rating_average', $rating_average );
				$data['success'] = _x( 'Rating successful', 'Ajax success message', 'walnut' );
				wp_send_json_success( $data );
				wp_die();
			}
		}
		
		public function register_js() {
			wp_register_script( 'rating.js', get_template_directory_uri() . '/core/tmpl/js/rating.js?v=1.0.0',
				array( 'jquery' ), '1.0.0' );
			wp_enqueue_script( 'rating.js' );
			wp_localize_script( 'rating.js', 'dataRatings', array(
				'url' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'put-wt_star' )
			) );
		}
		
		private function calc_rating( $post_id ) {
			$post_id = (int)$post_id;
			$ratings = get_post_meta( $post_id, '_wt_ratings' );
			$ratings = isset( $ratings[0] ) ? $ratings[0] : $ratings;
			$count_ratings = count( $ratings );
			$rating_count = 0;
			foreach( $ratings as $rating ) {
				$value = explode( '-', $rating );
				$rating_count += $value[1];
			}
			unset( $rating );
			
			return array( 'count' => $count_ratings, 'average' => $count_ratings ? $rating_count / $count_ratings : 0 );
		}
	}