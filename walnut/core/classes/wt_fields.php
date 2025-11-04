<?php
	//avoid direct calls to this file where wp core files not present
	if( ! function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Fields {
		
		private static $instance = null;
		
		private $prefix = 'wt_';
		
		//Generate switcher. If $generated is true then all methods will not run
		private $generated = false;
		//Post types for enabling custom fields
		private $post_types = array();
		//Current post type. If $post_type is not establish, getters, setters and create methods will not run
		private $post_type;
		
		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		private function __construct() {
			//Add fields actions
			add_action( 'wt_fields_generate_after', array( &$this, 'save_fields_settings' ) );
			//Generate fields
			add_action( 'after_setup_theme', array( &$this, 'generate' ) );
			//Add script for fields
			add_action( 'wp_enqueue_scripts', array( &$this, 'register_js' ) );
		}

		public function add_post_type( $post_type, $page_slug ) {
			if( $this->generated ) {
				return $this->generate_error();
			}
			
			if( ! in_array( $post_type, $this->post_types ) ) {
				$this->post_types[$page_slug] = $post_type;
				
				return true;
			}
			
			return false;
		}
		
		public function get_post_type() {
			if( isset( $_GET['post_type'] ) ) {
				$this->post_type = $_GET['post_type'];
			} else {
				global $typenow;
				if( $typenow ) {
					$this->post_type = $typenow;
				}
			}

			return $this->post_type;
		}
		
		public function set_post_type( $post_type ) {
			if( $this->generated ) {
				return $this->generate_error();
			}
			
			$this->post_type = $post_type;
			
			return true;
		}
		
		public function generate() {
			if( $this->generated ) {
				return $this->generate_error();
			}
			do_action( 'wt_fields_generate_before' );
			//Add custom fields settings for post types
			foreach( $this->post_types as $page_slug => $post_type ) {
				add_action( 'load-' . $post_type . '_page_' . $page_slug, array( &$this, 'load_fields_settings' ) );
			}
			
			//Register meta boxes for post types
			add_action( 'add_meta_boxes', array( &$this, 'register_meta_boxes' ) );
			//Save custom data for post types
			add_action( 'save_post', array( &$this, 'save_meta_boxes' ) );
			
			$this->generated = true;
			do_action( 'wt_fields_generate_after' );

			return $this->generated;
		}
		
		public function load_fields_settings() {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return false;
			}
			
			if( ! isset( $_GET['post_type'] ) || ! isset( $_GET['page'] ) || ! $_GET['post_type'] || ! $_GET['page'] ) {
				return $this->page_hook_error();
			}
			add_meta_box( 'wt_fields', _x( 'Custom fields', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_fields_settings'
			), $_GET['post_type'] . '_page_' . $_GET['page'], 'normal', 'low' );
			//Add script for fields settings
			add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_js' ) );
			
			return true;
		}
		
		public function add_meta_box_fields_settings() {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return false;
			}

			wp_nonce_field( $this->post_type, $this->post_type );
			$fields = $this->form_fields( false );
			if( file_exists( get_template_directory() . '/core/tmpl/metaboxes/wt_fields/fields.php' ) ) {
				include get_template_directory() . '/core/tmpl/metaboxes/wt_fields/fields.php';
			}
			
			return true;
		}
		
		public function save_fields_settings() {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return false;
			}
			if( isset( $_POST['submit'] ) && isset( $_POST['fields'] ) ) {
				$fields = $_POST['fields'];

				return update_option( $this->post_type . '_fields_settings', $fields );
			}

			return false;
		}
		
		public function register_meta_boxes() {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return false;
			}
			
			global $typenow;
			add_meta_box( $typenow . '-fields', _x( 'Custom fields', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_fields'
			), $typenow, 'normal', 'low' );
			
			return true;
		}
		
		public function add_meta_box_fields( $post ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return false;
			}
			
			wp_nonce_field( $this->post_type, $this->post_type );
			$fields = $this->form_fields( false );
			if( $fields ) {
				foreach( $fields as $field ) {
					$data = $this->get_meta( $post->ID, $field['code'] );
					$this->get_template( $field, $data, false );
				}

				return true;
			}

			return false;
		}
		
		function save_meta_boxes( $post_id ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return false;
			}

			if( ! current_user_can( 'edit_post', $post_id ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
				return $post_id;
			}
			
			if( !isset( $_POST[$this->post_type] ) || ! wp_verify_nonce( $_POST[$this->post_type], $this->post_type ) ) {
				return $post_id;
			}
			
			if( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
				if( ! current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if( ! current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}

			$this->save_fields( $post_id );
			
			return $post_id;
		}
		
		private function save_fields( $post_id, $is_frontend = false ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return false;
			}
			
			$fields = $this->form_fields( false );
			if( $fields && ! empty( $fields ) ) {
				foreach( $fields as $field ) {
					$code = $this->add_prefix( $field['code'] );
					$item = null;
					if( in_array( $field['type'], array( 'text', 'rating' ) ) ) {
						if( isset( $_POST[$code] ) ) {
							$item = sanitize_text_field( $_POST[$code] );
						}
					} elseif( $field['type'] == 'confirm' ) {
						if( isset( $_POST[$code] ) ) {
							$item = $_POST[$code] ? true : false;
						}
					} elseif( in_array( $field['type'], array( 'image', 'file', 'video' ) ) ) {
						if( $is_frontend ) {
							if( isset( $_FILES[$code]['error'] ) && $_FILES[$code]['error'] == UPLOAD_ERR_OK ) {
								$item = media_handle_upload( $code, 0 );
							}
						} else {
							$item = sanitize_text_field( $_POST[$code] );
						}
					} elseif( in_array( $field['type'], array( 'images', 'files', 'videos' ) ) ) {
						if( $is_frontend ) {
							if( isset( $_FILES[$code] ) && ! empty( $_FILES[$code]['name'] ) ) {
								$item = array();
								$files = $_FILES[$code];
								foreach( $files['name'] as $key => $value ) {
									if( $files['name'][$key] ) {
										$file = array(
											'name' => $files['name'][$key], 'type' => $files['type'][$key],
											'tmp_name' => $files['tmp_name'][$key], 'error' => $files['error'][$key],
											'size' => $files['size'][$key]
										);
										$item[] = media_handle_sideload( $file, 0 );
									}
								}
							}
						} else {
							if( isset( $_POST[$code] ) && ! empty( $_POST[$code] ) ) {
								foreach( $_POST[$code] as $id => $data ) {
									$item_tmp = is_int( $id ) ? $id : null;
									if( $item_tmp ) {
										$item[] = $item_tmp;
									}
								}
							}
						}
					}
					if( $item ) {
						$this->update_meta( $post_id, $field['code'], $item );
					} else {
						$this->delete_meta( $post_id, $field['code'] );
					}
				}
			}
			
			return true;
		}
		
		function register_js() {
			wp_register_script( 'fields.js', get_template_directory_uri() . '/core/tmpl/js/fields.js',
				array( 'jquery', ), true );
			wp_enqueue_script( 'fields.js' );
		}
		
		function register_admin_js() {
			wp_register_script( 'fields-settings.js', get_template_directory_uri() . '/core/tmpl/js/fields-settings.js',
				array( 'jquery', ), true );
			wp_enqueue_script( 'fields-settings.js' );
		}
		
		private function get_template( $field, $data = null, $is_frontend = true, $is_form = false ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			if( $is_form ) {
				$path = '/wt_fields/fields/';
			} elseif( $is_frontend ) {
				$path = '/wt_fields/form_fields/';
			} else {
				$path = '/metaboxes/wt_fields/fields/';
			}
			if( file_exists( get_template_directory() . '/core/tmpl' . $path . $field['type'] . '.php' ) ) {
				include get_template_directory() . '/core/tmpl' . $path . $field['type'] . '.php';
			}

			return null;
		}
		
		private function remove_prefix( $value ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			return preg_replace( '/^' . $this->prefix . '/i', '', $value );
		}
		
		private function add_prefix( $value ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			return $this->prefix . $this->remove_prefix( $value );
		}
		
		private function get_meta( $post_id, $code ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			return get_post_meta( $post_id, '_' . $this->post_type . '_' . $this->remove_prefix( $code ), true );
		}
		
		private function update_meta( $post_id, $code, $value ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			return update_post_meta( $post_id, '_' . $this->post_type . '_' . $this->remove_prefix( $code ), $value );
		}
		
		private function delete_meta( $post_id, $code ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			return delete_post_meta( $post_id, '_' . $this->post_type . '_' . $this->remove_prefix( $code ) );
		}
		
		public function get_fields( $post_id ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			$fields = array();
			if( $post_id ) {
				$fields = $this->form_fields( false );
				foreach( $fields as &$field ) {
					$field['value'] = $this->get_meta( $post_id, $field['code'] );
				}
				unset( $field );
			}
			
			return $fields;
		}
		
		public function get_field( $field_code, $post_id ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			if( $field_code && $post_id ) {
				$fields = $this->form_fields( false );
				foreach( $fields as $field ) {
					if( $field['code'] == $field_code ) {
						$field['value'] = $this->get_meta( $post_id, $field['code'] );
						
						return $field;
					}
				}
			}
			
			return null;
		}
		
		public function echo_field( $field ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			if( isset( $field['value'] ) && $field['value'] ) {
				$this->get_template( $field, null, true, true );
			}

			return null;
		}
		
		public function form_fields( $echo = true ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			if( $echo ) {
				if( file_exists( get_template_directory() . '/core/tmpl/wt_fields/form.php' ) ) {
					include get_template_directory() . '/core/tmpl/wt_fields/form.php';
				}
			}

			return get_option( $this->post_type . '_fields_settings' );
		}
		
		public function form_field( $field_code, $echo = true ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			$fields = $this->form_fields( false );
			foreach( $fields as $field ) {
				if( $field['code'] == $field_code ) {
					if( $echo ) {
						$this->echo_form_field( $field_code );
					}
					
					return $field;
				}
			}
			
			return null;
		}
		
		public function echo_form_field( $field_code ) {
			if( ! in_array( $this->get_post_type(), $this->post_types ) ) {
				return $this->post_type_error_set();
			}
			
			$fields = $this->form_fields( false );
			foreach( $fields as $field ) {
				if( $field['code'] == $field_code ) {
					$this->get_template( $field );
				}
			}

			return null;
		}
		
		private function post_type_error_set() {
			user_error( _x( 'Current post type is not set. Please, set current post type by set_post_type( "post_type" ) method by using action "wt_fields_generate_before".',
				'User error', 'walnut' ) );
			
			return false;
		}
		
		private function generate_error() {
			user_error( _x( 'Custom fields had generated already. You must call methods by using action "wt_fields_generate_before".',
				'User error', 'walnut' ) );
			
			return false;
		}
		
		private function page_hook_error() {
			user_error( _x( 'Page hook is not set. Global massive $_GET must contain indexes "post_type" and "page".',
				'User error', 'walnut' ) );
			
			return false;
		}
		
	}