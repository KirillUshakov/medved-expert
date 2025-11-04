<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Testimonials {
		
		private static $instance = null;
		
		public $pagehook;
		public $pageslug = 'testimonials_settings';
		
		private $prefix = 'wt_';
		public $post_type = 'wt_testimonial';
		
		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		private function __construct() {
			//Register post type Testimonials
			add_action( 'init', array( &$this, 'register_post_type' ) );
			//Register statuses for testimonials
			add_action( 'init', array( &$this, 'register_statuses' ) );
			//Change actions in testimonials table
			add_filter( 'post_row_actions', array( &$this, 'row_actions' ), 10, 2 );
			//Add classes for tr in admin list table
			add_filter( 'post_class', array( &$this, 'post_classes' ) );
			//Register functions for change status of testimonial
			add_action( 'admin_post_approve', array( &$this, 'admin_testimonials_approve' ) );
			add_action( 'admin_post_unapprove', array( &$this, 'admin_testimonials_unapprove' ) );
			add_action( 'admin_post_reject', array( &$this, 'admin_testimonials_reject' ) );
			//Register new testimonials table columns
			add_filter( 'manage_edit-' . $this->post_type . '_columns', array( $this, 'add_table_columns' ) );
			//Output data to testimonials table columns
			add_action( 'manage_' . $this->post_type . '_posts_custom_column', array(
				$this, 'output_table_columns_data',
			), 10, 2 );
			//Add Awaiting Moderation to testimonials
			add_action( 'auth_redirect', array( &$this, 'add_count_filter' ) );
			add_action( 'admin_menu', array( &$this, 'esc_attr_restore' ) );
			//Change form enctype
			add_action( 'post_edit_form_tag', array( &$this, 'update_edit_form' ) );
			//Register meta boxes of editing testimonials
			add_action( 'add_meta_boxes', array( &$this, 'register_meta_boxes' ) );
			//Save custom data of testimonials
			add_action( 'save_post', array( &$this, 'save_meta_boxes' ) );
			//Save testimonial from site form
			add_action( 'admin_post_add_wt_testimonial', array( &$this, 'add_testimonial' ) );
			add_action( 'admin_post_nopriv_add_wt_testimonial', array( &$this, 'add_testimonial' ) );
			//Prepare screen for testimonials settings page
			add_filter( 'screen_layout_columns', array( &$this, 'on_screen_layout_columns' ), 10, 2 );
			//Call functions to add testimonials settings page
			add_action( 'admin_menu', array( &$this, 'on_admin_menu' ) );
			//include settings call functions
			add_action( 'admin_init', array( &$this, $this->pageslug ) );
			//Set archive description
			add_filter( 'get_the_archive_description', array( &$this, 'archive_description' ) );
			//Add links to view/edit settings in admin bar
			add_action( 'admin_bar_menu', array( &$this, 'admin_bar_links' ), 100 );
			
			add_action( 'wp_enqueue_scripts', array( &$this, 'register_js' ) );
			
			add_filter( 'wp_video_extensions', array( &$this, 'add_video_formats' ) );
			
			add_filter( 'pre_get_posts', array( &$this, 'filter_search' ) );
		}
		
		public function register_post_type() {
			$labels = array(
				'name' => _x( 'Testimonials', 'General name for post type', 'walnut' ),
				'singular_name' => _x( 'Testimonial', 'Single name for post type', 'walnut' ),
				'add_new' => _x( 'Add New', 'Text for button add a testimonial', 'walnut' ),
				'add_new_item' => _x( 'Add New Testimonial', 'Title for page of adding post', 'walnut' ),
				'edit_item' => _x( 'Edit Testimonial', 'Title for page of editing post', 'walnut' ),
				'new_item' => _x( 'New Testimonial', 'Text of new post', 'walnut' ),
				'view_item' => _x( 'View Testimonial', 'Text for viewing post', 'walnut' ),
				'search_items' => _x( 'Search Testimonials', 'Text for searching post', 'walnut' ),
				'not_found' => _x( 'No Testimonials yet', 'Text if no testimonials', 'walnut' ),
				'not_found_in_trash' => _x( 'No Testimonials in trash', 'Text if no testimonials in trash', 'walnut' ),
				'parent_item_colon' => '', 'menu_name' => _x( 'Testimonials', 'Name of menu', 'walnut' ),
			);
			
			register_post_type( $this->post_type, array(
				'labels' => $labels,
				'description' => _x( 'Testimonials for creating testimonials page', 'Description of post type',
					'walnut' ), 'public' => true, 'publicly_queryable' => true, 'show_ui' => true, 'query_var' => true,
				'rewrite' => array(
					'slug' => 'testimonials',
				), 'capability_type' => 'post', 'has_archive' => true, 'hierarchical' => false, 'menu_position' => 24,
				'menu_icon' => 'dashicons-format-status', 'supports' => array( 'excerpt', 'editor' ),
			) );
		}
		
		function register_statuses() {
			register_post_status( 'unapprove', array(
				'label' => _x( 'Unapprove', 'Label for status', 'walnut' ), 'public' => true,
				'exclude_from_search' => false, 'show_in_admin_all_list' => true, 'show_in_admin_status_list' => true,
				'label_count' => _n_noop( _x( 'Unapproved', 'Status of testimonial', 'walnut' ) .
					' <span class="count">(%s)</span>',
					_x( 'Unapproved', 'Status of testimonial', 'walnut' ) . ' <span class="count">(%s)</span>' ),
			) );
			register_post_status( 'approve', array(
				'label' => _x( 'Approve', 'Label for status', 'walnut' ), 'public' => true,
				'exclude_from_search' => false, 'show_in_admin_all_list' => true, 'show_in_admin_status_list' => true,
				'label_count' => _n_noop( _x( 'Approved', 'Status of testimonial', 'walnut' ) .
					' <span class="count">(%s)</span>',
					_x( 'Approved', 'Status of testimonial', 'walnut' ) . ' <span class="count">(%s)</span>' ),
			) );
			register_post_status( 'reject', array(
				'label' => _x( 'Reject', 'Label for status', 'walnut' ), 'public' => true,
				'exclude_from_search' => false, 'show_in_admin_all_list' => true, 'show_in_admin_status_list' => true,
				'label_count' => _n_noop( _x( 'Rejected', 'Status of testimonial', 'walnut' ) .
					' <span class="count">(%s)</span>',
					_x( 'Rejected', 'Status of testimonial', 'walnut' ) . ' <span class="count">(%s)</span>' ),
			) );
		}
		
		function row_actions( $actions, $post ) {
			if( $post && $post->post_type == $this->post_type ) {
				unset( $actions[ 'inline hide-if-no-js' ], $actions[ 'view' ] );
				if( $post->post_status == 'approve' ) {
					$actions[ 'reject trash' ] =
						'<a href="/wp-admin/admin-post.php?post=' . $post->ID . '&action=reject">' .
						_x( 'Reject', 'Action to change status of testimonial', 'walnut' ) . '</a>';
				} else {
					$actions[ 'approve' ] =
						'<a href="/wp-admin/admin-post.php?post=' . $post->ID . '&action=approve">' .
						_x( 'Approve', 'Action to change status of testimonial', 'walnut' ) . '</a>';
				}
			}
			
			return $actions;
		}
		
		function post_classes( $classes ) {
			global $post;
			
			if( $post->post_type == $this->post_type ) {
				if( $post->post_status == 'approve' ) {
					$classes[] = 'active';
				} else {
					$classes[] = 'unapproved';
				}
			}
			
			return $classes;
		}
		
		function admin_testimonials_approve() {
			$post = get_post( $_GET[ 'post' ] );
			if( $post && $post->post_type == $this->post_type ) {
				wp_update_post( array(
					'ID' => $post->ID, 'post_status' => 'approve',
				) );
			}
			wp_redirect( '/wp-admin/edit.php?post_type=' . $this->post_type );
		}
		
		function admin_testimonials_unapprove() {
			$post = get_post( $_GET[ 'post' ] );
			if( $post && $post->post_type == $this->post_type ) {
				wp_update_post( array(
					'ID' => $post->ID, 'post_status' => 'unapprove',
				) );
			}
			wp_redirect( '/wp-admin/edit.php?post_type=' . $this->post_type );
		}
		
		function admin_testimonials_reject() {
			$post = get_post( $_GET[ 'post' ] );
			if( $post && $post->post_type == $this->post_type ) {
				wp_update_post( array(
					'ID' => $post->ID, 'post_status' => 'reject',
				) );
			}
			wp_redirect( '/wp-admin/edit.php?post_type=' . $this->post_type );
		}
		
		function add_table_columns( $columns ) {
			wp_register_script( 'testimonials_table.js',
				get_template_directory_uri() . '/core/tmpl/js/testimonials_table.js', array( 'jquery' ), true );
			wp_enqueue_script( 'testimonials_table.js' );
			
			$arr_first = array_slice( $columns, 0, 2 );
			$arr_last = array_slice( $columns, 2 );
			$arr_center = array(
				'status' => _x( 'Status', 'Title of table column', 'walnut' ),
				'content' => _x( 'Content', 'Title of table column', 'walnut' ),
			);
			
			return array_merge( $arr_first, $arr_center, $arr_last );
		}
		
		function output_table_columns_data( $column, $post_id ) {
			$post = get_post( $post_id );
			switch( $column ) {
				case 'content':
					the_content();
					break;
				case 'status':
					switch( $post->post_status ) {
						case 'unapprove':
							echo _x( 'Unapproved', 'Status of testimonial', 'walnut' );
							break;
						case 'approve':
							echo _x( 'Approved', 'Status of testimonial', 'walnut' );
							break;
						case 'reject':
							echo _x( 'Rejected', 'Status of testimonial', 'walnut' );
							break;
						case 'publish':
							echo __( 'Published' );
							break;
						case 'trash':
							echo __( 'Trash' );
							break;
						default:
							echo $post->post_status;
							break;
					}
					break;
			}
			
			return;
		}
		
		public function add_count_filter() {
			add_filter( 'attribute_escape', array( &$this, 'add_awaiting_mod' ), 20, 2 );
		}
		
		function esc_attr_restore() {
			remove_filter( 'attribute_escape', array( &$this, 'add_awaiting_mod' ), 20 );
		}
		
		public function add_awaiting_mod( $safe_text = '', $text = '' ) {
			if( substr_count( $text, _x( 'Testimonials', 'General name for post type', 'walnut' ) ) ) {
				$text = trim( $text );
				// run only once!
				remove_filter( 'attribute_escape', array( &$this, 'add_awaiting_mod' ), 20 );
				$safe_text = esc_attr( $text );
				// remember to set the right cpt name below
				$count = (int)wp_count_posts( $this->post_type, 'readable' )->unapprove;
				if( $count > 0 ) {
					$text = esc_attr( $text );
					$text .= ' <span class="awaiting-mod count-' . $count . '">';
					$text .= '<span class="pending-count">' . $count . '</span></span>';
					
					return $text;
				}
			}
			
			return $safe_text;
		}
		
		function update_edit_form() {
			echo ' enctype="multipart/form-data"';
		}
		
		public function register_meta_boxes() {
			add_meta_box( 'testimonials-fields', _x( 'Fields', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_fields',
			), $this->post_type, 'normal', 'high' );
		}
		
		public function add_meta_box_fields( $post ) {
			wp_nonce_field( 'wt_testimonials', 'wt_testimonials' );
			$fields = $this->form_fields( false );
			foreach( $fields as $field ) {
				$data = $this->get_meta( $post->ID, $field[ 'code' ] );
				$this->get_template( $field, $data, false );
			}
		}
		
		private function get_template( $field, $data = null, $is_frontend = true, $is_form = false ) {
			if( $is_form ) {
				$path = '/wt_testimonials/fields/';
			} elseif( $is_frontend ) {
				$path = '/wt_testimonials/form_fields/';
			} else {
				$path = '/metaboxes/wt_testimonials/fields/';
			}
			if( file_exists( get_template_directory() . '/core/tmpl' . $path . $field[ 'type' ] . '.php' ) ) {
				include get_template_directory() . '/core/tmpl' . $path . $field[ 'type' ] . '.php';
			}
		}
		
		function save_meta_boxes( $post_id ) {
			if( !current_user_can( 'edit_post', $post_id ) || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) {
				return $post_id;
			}
			
			if( !isset( $_POST[ 'wt_testimonials' ] ) ) {
				return $post_id;
			}
			
			if( !wp_verify_nonce( $_POST[ 'wt_testimonials' ], 'wt_testimonials' ) ) {
				return $post_id;
			}
			
			if( !empty( $_POST[ 'post_type' ] ) && 'page' == $_POST[ 'post_type' ] ) {
				if( !current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if( !current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}
			
			$wp_count = wp_count_posts( $this->post_type );
			$count =
				(int)$wp_count->unapprove + (int)$wp_count->approve + (int)$wp_count->reject + (int)$wp_count->trash;
			$count++;
			if( in_array( get_post()->post_status, array( 'draft', 'auto-draft' ) ) ) {
				remove_action( 'save_post', array( &$this, 'save_meta_boxes' ) );
				
				wp_update_post( array(
					'ID' => $post_id,
					'post_title' => _x( 'Testimonial', 'Part of testimonial title', 'walnut' ) . ' ' . $count,
					'post_name' => sanitize_title( _x( 'Testimonial', 'Part of testimonial title', 'walnut' ) . ' ' .
						$count ),
				) );
				
				add_action( 'save_post', array( &$this, 'save_meta_boxes' ) );
			}
			if( !wp_is_post_revision( $post_id ) && $this->post_type == get_post_type( $post_id ) ) {
				remove_action( 'save_post', array( &$this, 'save_meta_boxes' ) );
				
				wp_update_post( array(
					'ID' => $post_id, 'post_status' => 'unapprove',
				) );
				
				add_action( 'save_post', array( &$this, 'save_meta_boxes' ) );
			}
			$this->save_fields( $post_id );
			
			return $post_id;
		}
		
		public function add_testimonial() {
			$wp_count = wp_count_posts( $this->post_type );
			$count =
				(int)$wp_count->unapprove + (int)$wp_count->approve + (int)$wp_count->reject + (int)$wp_count->trash;
			$count++;
			
			$post_id = wp_insert_post( array(
				'post_title' => _x( 'Testimonial', 'Part of testimonial title', 'walnut' ) . ' ' . $count,
				'post_type' => $this->post_type, 'post_status' => 'unapprove',
				'post_content' => $_POST[ 'post_content' ],
			) );
			
			$this->save_fields( $post_id, true );
			
			if( isset( $_POST[ 'redirect_url' ] ) ) {
				wp_safe_redirect( $_POST[ 'redirect_url' ] . '#testimonial-success' );
			} else {
				wp_redirect( home_url() . '#testimonial-success' );
			}
		}
		
		private function save_fields( $post_id, $is_frontend = false ) {
			$fields = $this->form_fields( false );
			if( $fields && !empty( $fields ) ) {
				foreach( $fields as $field ) {
					$code = $this->add_prefix( $field[ 'code' ] );
					$item = null;
					if( in_array( $field[ 'type' ], array( 'text', 'rating' ) ) ) {
						if( isset( $_POST[ $code ] ) ) {
							$item = sanitize_text_field( $_POST[ $code ] );
						}
					} elseif( $field[ 'type' ] == 'confirm' ) {
						if( isset( $_POST[ $code ] ) ) {
							$item = $_POST[ $code ] ? true : false;
						}
					} elseif( in_array( $field[ 'type' ], array( 'image', 'file', 'video' ) ) ) {
						if( $is_frontend ) {
							if( isset( $_FILES[ $code ][ 'error' ] ) && $_FILES[ $code ][ 'error' ] == UPLOAD_ERR_OK ) {
								$item = media_handle_upload( $code, 0 );
							}
						} else {
							$item = sanitize_text_field( $_POST[ $code ] );
						}
					} elseif( in_array( $field[ 'type' ], array( 'images', 'files', 'videos' ) ) ) {
						if( $is_frontend ) {
							if( isset( $_FILES[ $code ] ) && !empty( $_FILES[ $code ][ 'name' ] ) ) {
								$item = array();
								$files = $_FILES[ $code ];
								foreach( $files[ 'name' ] as $key => $value ) {
									if( $files[ 'name' ][ $key ] ) {
										$file = array(
											'name' => $files[ 'name' ][ $key ], 'type' => $files[ 'type' ][ $key ],
											'tmp_name' => $files[ 'tmp_name' ][ $key ],
											'error' => $files[ 'error' ][ $key ], 'size' => $files[ 'size' ][ $key ],
										);
										$item[] = media_handle_sideload( $file, 0 );
									}
								}
							}
						} else {
							if( isset( $_POST[ $code ] ) && !empty( $_POST[ $code ] ) ) {
								foreach( $_POST[ $code ] as $id => $data ) {
									$item_tmp = is_int( $id ) ? $id : null;
									if( $item_tmp ) {
										$item[] = $item_tmp;
									}
								}
							}
						}
					}
					if( $item ) {
						$this->update_meta( $post_id, $field[ 'code' ], $item );
					} else {
						$this->delete_meta( $post_id, $field[ 'code' ] );
					}
				}
			}
		}
		
		function on_screen_layout_columns( $columns, $screen ) {
			if( $screen == $this->pagehook ) {
				$columns[ $this->pagehook ] = 2;
			}
			
			return $columns;
		}
		
		public function on_admin_menu() {
			$this->pagehook = add_submenu_page( 'edit.php?post_type=' . $this->post_type,
				_x( 'Testimonial settings', 'Title of settings page', 'walnut' ),
				_x( 'Settings', 'Name of submenu page', 'walnut' ), 'manage_options', $this->pageslug,
				array( &$this, 'on_show_settings_page' ) );
			add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_settings_page' ) );
		}
		
		public function on_load_settings_page() {
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
			
			add_meta_box( 'wt_testimonials_main', _x( 'Main settings', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_settings_main',
			), $this->pagehook, 'normal', 'high' );
			
			add_meta_box( 'fields', _x( 'Fields', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_settings_fields',
			), $this->pagehook, 'normal', 'high' );
		}
		
		public function on_show_settings_page() {
			if( isset( $_POST[ 'submit' ] ) ) {
				$this->save_testimonials_settings();
			}
			if( file_exists( get_template_directory() . '/core/tmpl/admin/' . $this->pageslug . '.php' ) ) {
				require_once get_template_directory() . '/core/tmpl/admin/' . $this->pageslug . '.php';
			}
		}
		
		public function add_meta_box_settings_fields() {
			wp_nonce_field( 'wt_testimonials', 'wt_testimonials' );
			$fields = $this->form_fields( false );
			if( file_exists( get_template_directory() . '/core/tmpl/metaboxes/wt_testimonials/fields.php' ) ) {
				include get_template_directory() . '/core/tmpl/metaboxes/wt_testimonials/fields.php';
			}
		}
		
		private function save_testimonials_settings() {
			$fields = $_POST[ 'fields' ];
			update_option( $this->post_type . '_settings_fields', $fields );
			
			unset( $_POST[ 'option_page' ], $_POST[ '_wpnonce' ], $_POST[ '_wp_http_referer' ], $_POST[ 'submit' ], $_POST[ 'fields' ] );
			$valid = array();
			foreach( $_POST as $key => $value ) {
				if( $key == 'description' ) {
					$valid[ $key ] = wp_kses_post( $value );
				} else {
					$valid[ $key ] = trim( $value );
				}
			}
			update_option( 'wt_testimonials_settings', $valid );
		}
		
		public function add_meta_box_settings_main() {
			do_settings_sections( 'wt_testimonials_main' );
		}
		
		public function section_main() {
		}
		
		private function get_setting( $name ) {
			$options = get_option( 'wt_testimonials_settings' );
			if( isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}
			
			return false;
		}
		
		public function field_description() {
			wp_editor( $this->get_setting( 'description' ), $this->post_type . '_description',
				array( 'textarea_name' => 'description', 'media_buttons' => true ) );
		}
		
		public function archive_description( $description ) {
			if( is_post_type_archive( $this->post_type ) ) {
				$description = $this->get_setting( 'description' );
			}
			
			return wpautop( wp_kses_post( $description ) );
		}
		
		public function admin_bar_links( $admin_bar ) {
			if( !is_admin() && get_query_var( 'post_type' ) == $this->post_type ) {
				$admin_bar->add_menu( array(
					'id' => 'wp-admin-bar-edit',
					'title' => _x( 'Edit Testimonials Settings', 'Name of admin bar menu', 'walnut' ),
					'href' => admin_url( 'edit.php?post_type=' . $this->post_type . '&page=' . $this->pageslug ),
				) );
			}
			
			if( is_admin() && get_current_screen()->base == $this->post_type . '_page_' . $this->pageslug ) {
				$admin_bar->add_menu( array(
					'id' => 'wp-admin-bar-edit',
					'title' => _x( 'View Testimonials Page', 'Name of admin bar menu', 'walnut' ),
					'href' => get_post_type_archive_link( $this->post_type ),
				) );
			}
		}
		
		public function testimonials_settings() {
			add_settings_section( 'wt_testimonials_main',
				_x( 'Specify the main information', 'Help text for meta box', 'walnut' ),
				array( &$this, 'section_main' ), 'wt_testimonials_main' );
			
			add_settings_field( 'description', _x( 'Testimonials page description', 'Label for field', 'walnut' ),
				array( &$this, 'field_description' ), 'wt_testimonials_main', 'wt_testimonials_main' );
			
			register_setting( 'wt_testimonials_settings', 'description' );
			
			register_setting( 'wt_testimonials_settings', 'wt_testimonials_settings' );
		}
		
		function register_js() {
			wp_register_script( 'testimonials.js', get_template_directory_uri() . '/core/tmpl/js/testimonials.js',
				array( 'jquery', ), true );
			wp_enqueue_script( 'testimonials.js' );
		}
		
		public function add_video_formats( $exts ) {
			$exts[] = 'mov';
			
			return $exts;
		}
		
		function filter_search( $query ) {
			if( $query->is_admin && $query->is_post_type_archive &&
				$query->query_vars[ 'post_type' ] == $this->post_type && isset( $query->query_vars[ 'post_status' ] ) &&
				$query->query_vars[ 'post_status' ] != 'trash' ) {
				$query->set( 'post_status', array( 'approve', 'unapprove', 'reject' ) );
			}
			
			return $query;
		}
		
		private function get_meta( $post_id, $code ) {
			return get_post_meta( $post_id, '_' . $this->post_type . '_' . $this->remove_prefix( $code ), true );
		}
		
		private function update_meta( $post_id, $code, $value ) {
			return update_post_meta( $post_id, '_' . $this->post_type . '_' . $this->remove_prefix( $code ), $value );
		}
		
		private function delete_meta( $post_id, $code ) {
			return delete_post_meta( $post_id, '_' . $this->post_type . '_' . $this->remove_prefix( $code ) );
		}
		
		private function remove_prefix( $value ) {
			return preg_replace( '/^' . $this->prefix . '/i', '', $value );
		}
		
		private function add_prefix( $value ) {
			return $this->prefix . $this->remove_prefix( $value );
		}
		
		public function get_fields( $post_id ) {
			$fields = array();
			if( $post_id ) {
				$fields = $this->form_fields( false );
				foreach( $fields as &$field ) {
					$field[ 'value' ] = $this->get_meta( $post_id, $field[ 'code' ] );
				}
				unset( $field );
			}
			
			return $fields;
		}
		
		public function get_field( $field_code, $post_id ) {
			if( $field_code && $post_id ) {
				$fields = $this->form_fields( false );
				foreach( $fields as $field ) {
					if( $field[ 'code' ] == $field_code ) {
						$field[ 'value' ] = $this->get_meta( $post_id, $field[ 'code' ] );
						
						return $field;
					}
				}
			}
			
			return null;
		}
		
		public function echo_field( $field ) {
			if( isset( $field[ 'value' ] ) && $field[ 'value' ] ) {
				$this->get_template( $field, null, true, true );
			}
		}
		
		public function form_fields( $echo = true ) {
			if( $echo ) {
				if( file_exists( get_template_directory() . '/core/tmpl/wt_testimonials/form.php' ) ) {
					include get_template_directory() . '/core/tmpl/wt_testimonials/form.php';
				}
			}
			
			return get_option( $this->post_type . '_settings_fields' );
		}
		
		public function form_field( $field_code, $echo = true ) {
			$fields = $this->form_fields( false );
			foreach( $fields as $field ) {
				if( $field[ 'code' ] == $field_code ) {
					if( $echo ) {
						$this->echo_form_field( $field_code );
					}
					
					return $field;
				}
			}
			
			return null;
		}
		
		public function form_open( $echo = true, $redirect_url = '' ) {
			$redirect_url = $redirect_url ? esc_url( $redirect_url ) : $_SERVER[ 'REQUEST_URI' ];
			$content =
				'<form class="testimonial-form" action="/wp-admin/admin-post.php" enctype="multipart/form-data" method="post">';
			$content .= '<input type="hidden" name="action" value="add_wt_testimonial">';
			$content .= '<input type="hidden" name="redirect_url" value="' . $redirect_url . '" />';
			if( $echo ) {
				echo $content;
			}
			
			return $content;
		}
		
		public function form_close( $echo = true ) {
			$content = '</form>';
			if( $echo ) {
				echo $content;
			}
			
			return $content;
		}
		
		public function form_submit( $echo = true, $value = '' ) {
			if( $value ) {
				$value = sanitize_text_field( $value );
			} else {
				$value = __( 'Save' );
			}
			$content = '<input type="submit" value="' . $value . '"/>';
			if( $echo ) {
				echo $content;
			}
			
			return $content;
		}
		
		public function form_field_content( $echo = true, $placeholder = '', $required = true ) {
			$content = '<textarea name="post_content" id="post_content"';
			if( $placeholder ) {
				$placeholder = sanitize_text_field( $placeholder );
				$content .= ' placeholder="' . $placeholder . '"';
			}
			if( $required ) {
				$content .= ' required';
			}
			$content .= '></textarea>';
			if( $echo ) {
				echo $content;
			}
			
			return $content;
		}
		
		public function echo_form_field( $field_code ) {
			$fields = $this->form_fields( false );
			foreach( $fields as $field ) {
				if( $field[ 'code' ] == $field_code ) {
					$this->get_template( $field );
				}
			}
		}
	}