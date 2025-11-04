<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Gallery {
		
		public $pagehook;
		public $pageslug = 'gallery_settings';
		public $pagegrid;
		public $pagesettings;
		public $count;
		public $photos;
		
		private $post_type = 'wt_photo';
		private $slug = 'wt_gallery';
		
		private $rewrite_slug = 'gallery';
		
		public function __construct() {
			//Register taxonomy Albums
			add_action( 'init', array( &$this, 'register_taxonomy' ) );
			//Register post type Photos
			add_action( 'init', array( &$this, 'register_post_type' ) );
			//Add taxonomy filter to admin page list of photos
			add_action( 'restrict_manage_posts', array( &$this, 'add_taxonomy_filter' ) );
			//Parse query of taxonomy filter
			add_filter( 'parse_query', array( &$this, 'parse_query_filter' ) );
			//Register new photos table columns
			add_filter( 'manage_edit-' . $this->post_type . '_columns', array( $this, 'add_table_columns' ) );
			//Output data to photos table columns
			add_action( 'manage_' . $this->post_type . '_posts_custom_column', array(
				$this, 'output_table_columns_data',
			), 10, 2 );
			//Replace checkboxes onto radio buttons in taxonomy terms meta box
			add_filter( 'wp_terms_checklist_args', array( &$this, 'radio_buttons_tax_terms' ) );
			
			//Add support custom fields
			add_action( 'wt_fields_generate_before', array( &$this, 'add_support_fields' ) );
			
			//Set Human-friendly URL for post links, add or remove base taxonomy slug
			add_filter( 'post_type_link', array( &$this, 'post_link' ), 10, 3 );
			add_filter( 'term_link', array( &$this, 'term_link' ), 10, 3 );
			//Remove taxonomy base slug from terms
			$this->remove_slug();
			
			//Prepare screen for multiple upload page
			add_filter( 'screen_layout_columns', array( &$this, 'on_screen_layout_columns' ), 10, 2 );
			//Call functions to add multiple upload page
			add_action( 'admin_menu', array( &$this, 'on_admin_menu' ) );
			//include settings call functions
			add_action( 'admin_init', array( &$this, $this->pageslug ) );
			//Set archive description
			add_filter( 'get_the_archive_description', array( &$this, 'archive_description' ) );
			//Add links to view/edit settings in admin bar
			add_action( 'admin_bar_menu', array( &$this, 'admin_bar_links' ), 100 );
			
			add_action( 'wp_enqueue_scripts', array( &$this, 'register_scripts' ) );
		}
		
		public function register_taxonomy() {
			$labels = array(
				'name' => _x( 'Albums', 'General name for taxonomy', 'walnut' ),
				'singular_name' => _x( 'Album', 'Single name for taxonomy', 'walnut' ),
				'menu_name' => _x( 'Albums', 'Name of menu', 'walnut' ),
				'search_items' => _x( 'Search Albums', 'Text for searching taxonomy', 'walnut' ),
				'popular_items' => null, 'all_items' => _x( 'All Albums', 'All items of taxonomy', 'walnut' ),
				'edit_item' => _x( 'Edit Album', 'Title for page of editing taxonomy item', 'walnut' ),
				'update_item' => _x( 'Update Album', 'Text for updating taxonomy item', 'walnut' ),
				'add_new_item' => _x( 'Add New Album', 'Text of new taxonomy item', 'walnut' ),
				'view_item' => _x( 'View Album', 'Text for viewing taxonomy item', 'walnut' ),
				'new_item_name' => _x( 'New Album', 'Text for creating taxonomy item', 'walnut' ),
				'separate_items_with_commas' => null,
				'add_or_remove_items' => _x( 'Add or remove albums', 'Text of deleting or creating taxonomy item',
					'walnut' ),
				'choose_from_most_used' => _x( 'Choose from most used albums', 'Text for most used taxonomy items',
					'walnut' ), 'not_found' => _x( 'Not found', 'Text for not founding taxonomy items', 'walnut' ),
			);
			register_taxonomy( $this->slug, array( $this->post_type ), array(
				'labels' => $labels, 'show_tagcloud' => false, 'hierarchical' => true,
				//Set it true, because it is not tatg, WordPress create terms for tags
				'update_count_callback' => '', 'capabilities' => array(), 'meta_box_cb' => 'post_categories_meta_box',
				'sort' => true, 'show_admin_column' => true, 'query_var' => true, 'has_archive' => true,
				'rewrite' => array(
					'slug' => '%' . $this->rewrite_slug . '%', 'with_front' => false,
				),
			) );
		}
		
		public function register_post_type() {
			$labels = array(
				'name' => _x( 'Photos', 'General name for post type', 'walnut' ),
				'singular_name' => _x( 'Photo', 'Single name for post type', 'walnut' ),
				'add_new' => _x( 'Add New', 'Text for button add a photo', 'walnut' ),
				'add_new_item' => _x( 'Add New Photo', 'Title for page of adding post', 'walnut' ),
				'edit_item' => _x( 'Edit Photo', 'Title for page of editing post', 'walnut' ),
				'new_item' => _x( 'New Photo', 'Text of new post', 'walnut' ),
				'view_item' => _x( 'View Photo', 'Text for viewing post', 'walnut' ),
				'search_items' => _x( 'Search Photos', 'Text for searching post', 'walnut' ),
				'not_found' => _x( 'No Photos yet', 'Text if no photos', 'walnut' ),
				'not_found_in_trash' => _x( 'No Photos in trash', 'Text if no photos in trash', 'walnut' ),
				'parent_item_colon' => '', 'all_items' => _x( 'Photos', 'Name of menu', 'walnut' ),
				'menu_name' => _x( 'Gallery', 'Name of menu', 'walnut' ),
			);
			
			register_post_type( $this->post_type, array(
				'labels' => $labels,
				'description' => _x( 'Photos for creating photos page', 'Description of post type', 'walnut' ),
				'public' => true, 'publicly_queryable' => true, 'show_ui' => true, 'query_var' => true,
				'rewrite' => array(
					'slug' => $this->rewrite_slug, 'with_front' => false,
				), 'capability_type' => 'post', 'has_archive' => true, 'hierarchical' => false, 'menu_position' => 14,
				'menu_icon' => 'dashicons-images-alt', 'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail' ),
				'taxonomies' => array( $this->slug ),
			) );
		}
		
		public function add_taxonomy_filter( $post_type ) {
			global $wp_query;
			if( $post_type == $this->post_type ) {
				if( file_exists( get_template_directory() . '/core/tmpl/metaboxes/wt_gallery/view_switch.php' ) ) {
					include get_template_directory() . '/core/tmpl/metaboxes/wt_gallery/view_switch.php';
				}
				
				$term = isset( $wp_query->query[ $this->slug ] ) ? $wp_query->query[ $this->slug ] : 0;
				wp_dropdown_categories( array(
					'show_option_all' => _x( 'All Albums', 'All items of taxonomy', 'walnut' ),
					'taxonomy' => $this->slug, 'name' => $this->slug, 'orderby' => 'name', 'selected' => $term,
					'hierarchical' => true, 'depth' => 1, 'show_count' => true, 'hide_empty' => false,
				) );
			}
		}
		
		function parse_query_filter( $query ) {
			global $pagenow;
			$qv = &$query->query_vars;
			if( $pagenow == 'edit.php' && isset( $qv[ 'post_type' ] ) && $qv[ 'post_type' ] == $this->post_type &&
				isset( $qv[ $this->slug ] ) && is_numeric( $qv[ $this->slug ] ) ) {
				$term = get_term_by( 'id', $qv[ $this->slug ], $this->slug );
				if( $term ) {
					$qv[ $this->slug ] = $term->slug;
				}
			}
			if( isset( $qv[ $this->slug ] ) ) {
				set_query_var( 'post_type', $this->post_type );
			}
		}
		
		function add_table_columns( $columns ) {
			$arr_first = array_slice( $columns, 0, 2 );
			$arr_last = array_slice( $columns, 2 );
			$arr_center = array(
				'image' => _x( 'Image', 'Title of table column', 'walnut' ),
			);
			
			return array_merge( $arr_first, $arr_center, $arr_last );
		}
		
		function output_table_columns_data( $column, $post_id ) {
			switch( $column ) {
				case 'image':
					the_post_thumbnail( 'thumbnail' );
					break;
			}
			
			return;
		}
		
		function radio_buttons_tax_terms( $args ) {
			if( !empty( $args[ 'taxonomy' ] ) && $args[ 'taxonomy' ] === $this->slug ) {
				if( empty( $args[ 'walker' ] ) || is_a( $args[ 'walker' ], 'Walker' ) ) {
					get_template_part( 'core/classes/wt_tax_radio_checklist' );
					$args[ 'walker' ] = new WT_Tax_Radio_Checklist();
				}
			}
			
			return $args;
		}
		
		public function add_support_fields() {
			WT_Fields::instance()->add_post_type( $this->post_type, $this->pageslug );
		}
		
		function post_link( $permalink, $post, $leavename ) {
			if( strpos( $permalink, $this->rewrite_slug ) === false ) {
				return $permalink;
			}
			if( !$post ) {
				return $permalink;
			}
			
			$slug = '';
			
			$terms = wp_get_post_terms( $post->ID, $this->slug );
			if( $terms && $terms[ 0 ] ) {
				$ancestors = array_reverse( get_ancestors( $terms[ 0 ]->term_id, $this->slug ) );
				foreach( $ancestors as $id ) {
					$term = get_term_by( 'id', $id, $this->slug );
					if( $term ) {
						$slugs[] = $term->slug;
					}
				}
				$slugs[] = $terms[ 0 ]->slug;
				$slug = implode( '/', $slugs );
			}
			$options = get_option( 'wt_settings' );
			if( isset( $options[ 'remove_slug_gallery' ] ) && $options[ 'remove_slug_gallery' ] ) {
				if( !isset( $slugs ) || empty( $slugs ) ) {
					$slug = $this->post_type . '/';
				} else {
					$slug .= '/';
				}
			} else {
				if( $slug ) {
					$slug = $this->rewrite_slug . '/' . $slug . '/';
				} else {
					$slug = $this->rewrite_slug . '/' . $slug;
				}
			}
			
			return str_replace( $this->rewrite_slug . '/', $slug, $permalink );
		}
		
		function term_link( $url, $term, $taxonomy ) {
			if( strpos( $url, '%' . $this->rewrite_slug . '%' ) === false ) {
				return $url;
			}
			if( !$term ) {
				return $url;
			}
			
			return str_replace( '%', '', $url );
		}
		
		private function remove_slug() {
			$options = get_option( 'wt_settings' );
			
			//Refresh rules
			add_action( 'created_' . $this->slug, array( &$this, 'refresh_rules' ) );
			add_action( 'delete_' . $this->slug, array( &$this, 'refresh_rules' ) );
			add_action( 'edited_' . $this->slug, array( &$this, 'refresh_rules' ) );
			
			add_filter( $this->slug . '_rewrite_rules', array( &$this, 'taxonomy_base_rewrite_rules' ) );
			//Add or remove base slug
			if( isset( $options[ 'remove_slug_gallery' ] ) && $options[ 'remove_slug_gallery' ] ) {
				add_action( 'init', array( &$this, 'no_taxonomy_base_permastruct' ) );
				// Adds 'category_redirect' query variable
				add_filter( 'query_vars', array( &$this, 'no_taxonomy_base_query_vars' ) );
				// Redirects if 'category_redirect' is set
				add_filter( 'request', array( &$this, 'no_taxonomy_base_request' ) );
			}
		}
		
		function refresh_rules() {
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}
		
		function taxonomy_base_rewrite_rules( $rewrite ) {
			global $wp_rewrite;
			$rewrite = array();
			
			/* WPML is present: temporary disable terms_clauses filter to get all categories for rewrite */
			
			if( class_exists( 'Sitepress' ) ) {
				global $sitepress;
				
				remove_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ) );
				$terms = get_terms( array(
					'taxonomy' => $this->slug, 'hide_empty' => false, 'orderby' => 'id', 'order' => 'DESC',
				) );
				add_filter( 'terms_clauses', array( $sitepress, 'terms_clauses' ) );
			} else {
				$terms = get_terms( array(
					'taxonomy' => $this->slug, 'hide_empty' => false, 'orderby' => 'id', 'order' => 'DESC',
				) );
			}
			
			$options = get_option( 'wt_settings' );
			
			if( isset( $options[ 'remove_slug_gallery' ] ) && $options[ 'remove_slug_gallery' ] ) {
				foreach( $terms as $term ) {
					$taxonomy_nicename = $term->slug;
					
					if( $term->parent == $term->term_ID ) {
						$term->parent = 0;
					} elseif( $term->parent != 0 ) {
						$taxonomy_nicename =
							get_category_parents( $term->parent, false, '/', true ) . $taxonomy_nicename;
					}
					
					$rewrite[ '(' . $taxonomy_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$' ] =
						'index.php?' . $this->slug . '=$matches[1]&feed=$matches[2]';
					$rewrite[ "({$taxonomy_nicename})/{$wp_rewrite->pagination_base}/?([0-9]{1,})/?$" ] =
						'index.php?' . $this->slug . '=$matches[1]&paged=$matches[2]';
					$rewrite[ '(' . $taxonomy_nicename . ')/?$' ] = 'index.php?' . $this->slug . '=$matches[1]';
				}
			} else {
				foreach( $terms as $term ) {
					$taxonomy_nicename = $term->slug;
					
					if( $term->parent == $term->term_ID ) {
						$term->parent = 0;
					} elseif( $term->parent != 0 ) {
						$taxonomy_nicename =
							get_category_parents( $term->parent, false, '/', true ) . $taxonomy_nicename;
					}
					
					$rewrite[ $this->rewrite_slug . '/(' . $taxonomy_nicename . ')/?$' ] =
						'index.php?' . $this->slug . '=$matches[1]';
				}
				
				foreach( $terms as $term ) {
					$taxonomy_nicename = $term->slug;
					
					if( $term->parent == $term->term_ID ) {
						$term->parent = 0;
					} elseif( $term->parent != 0 ) {
						$taxonomy_nicename =
							get_category_parents( $term->parent, false, '/', true ) . $taxonomy_nicename;
					}
					
					$rewrite[ $this->rewrite_slug . '/' . $taxonomy_nicename . '/(.+)/?$' ] =
						'index.php?' . $this->post_type . '=$matches[1]';
					$rewrite[ $this->rewrite_slug . '/?$' ] =
						'index.php?taxonomy=' . $this->slug . '&post_type=' . $this->post_type;
				}
				
			}
			
			return $rewrite;
		}
		
		function no_taxonomy_base_permastruct() {
			global $wp_rewrite;
			global $wp_version;
			
			if( $wp_version >= 3.4 ) {
				$wp_rewrite->extra_permastructs[ $this->slug ][ 'struct' ] = '%' . $this->slug . '%';
			} else {
				$wp_rewrite->extra_permastructs[ $this->slug ][ 0 ] = '%' . $this->slug . '%';
			}
		}
		
		function no_taxonomy_base_query_vars( $public_query_vars ) {
			$public_query_vars[] = $this->slug . '_redirect';
			
			return $public_query_vars;
		}
		
		function no_taxonomy_base_request( $query_vars ) {
			if( isset( $query_vars[ $this->slug . '_redirect' ] ) ) {
				$link = trailingslashit( esc_url( home_url() ) ) .
					user_trailingslashit( $query_vars[ $this->slug . '_redirect' ], $this->slug );
				status_header( 301 );
				header( "Location: $link" );
				exit();
			}
			
			return $query_vars;
		}
		
		function on_screen_layout_columns( $columns, $screen ) {
			if( $screen == $this->pagehook ) {
				$columns[ $this->pagehook ] = 2;
			}
			
			return $columns;
		}
		
		public function on_admin_menu() {
			$this->pagehook = add_submenu_page( 'edit.php?post_type=' . $this->post_type,
				_x( 'Multiple Upload', 'Title of upload page', 'walnut' ),
				_x( 'Multiple Upload', 'Name of submenu page', 'walnut' ), 'manage_options', 'multiple_upload',
				array( &$this, 'on_show_upload_page' ) );
			add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_upload_page' ) );
			add_action( 'admin_print_scripts-' . $this->pagehook, array( &$this, 'register_admin_scripts' ) );
			
			$this->pagegrid = add_submenu_page( 'edit.php?post_type=' . $this->post_type,
				_x( 'Photos', 'Title of photos grid page', 'walnut' ),
				_x( 'Grid View', 'Name of submenu page', 'walnut' ), 'manage_options', 'gallery_grid',
				array( &$this, 'on_show_grid_page' ) );
			add_action( 'load-' . $this->pagegrid, array( &$this, 'on_load_grid_page' ) );
			
			$this->pagesettings = add_submenu_page( 'edit.php?post_type=' . $this->post_type,
				_x( 'Gallery settings', 'Title of settings page', 'walnut' ),
				_x( 'Settings', 'Name of submenu page', 'walnut' ), 'manage_options', $this->pageslug,
				array( &$this, 'on_show_settings_page' ) );
			add_action( 'load-' . $this->pagesettings, array( &$this, 'on_load_settings_page' ) );
		}
		
		public function on_load_upload_page() {
			add_meta_box( 'multiple_upload', _x( 'Multiple Upload', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_multiple_upload',
			), $this->pagehook, 'normal', 'high' );
		}
		
		public function register_admin_scripts() {
			if( !did_action( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
		}
		
		public function on_show_upload_page() {
			if( isset( $_POST[ 'submit' ] ) ) {
				$this->save_multiple_upload();
			}
			require_once get_template_directory() . '/core/tmpl/admin/multiple_upload.php';
		}
		
		public function add_meta_box_multiple_upload( $post ) {
			require_once get_template_directory() . '/core/tmpl/metaboxes/wt_gallery/upload_photos.php';
		}
		
		private function save_multiple_upload() {
			if( isset( $_POST[ 'photos' ] ) ) {
				foreach( $_POST[ 'photos' ] as $id => $photo ) {
					$post_id = wp_insert_post( array(
						'post_title' => wp_strip_all_tags( $photo[ 'title' ] ), 'post_type' => $this->post_type,
						'post_status' => 'publish',
					) );
					wp_set_post_terms( $post_id, array( (int)$_POST[ 'albums_id' ] ), $this->slug );
					set_post_thumbnail( $post_id, $id );
				}
			}
			wp_redirect( admin_url( '/edit.php?post_type=' . $this->post_type ) );
		}
		
		public function on_load_grid_page() {
			if( isset( $_GET[ 'post_status' ] ) &&
				in_array( $_GET[ 'post_status' ], array( 'publish', 'pending', 'trash' ) ) ) {
				$status = $_GET[ 'post_status' ];
				if( !$this->count->$status ) {
					wp_redirect( admin_url( 'edit.php?post_type=' . $this->post_type . '&page=gallery_grid' ) );
					
					return true;
				}
			}
			if( !did_action( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'media-grid' );
			wp_enqueue_script( 'media' );
		}
		
		public function on_show_grid_page() {
			$this->count = wp_count_posts( $this->post_type );
			
			$args = array( 'post_type' => $this->post_type, 'posts_per_page' => -1 );
			if( isset( $_GET[ 'post_status' ] ) &&
				in_array( $_GET[ 'post_status' ], array( 'publish', 'pending', 'trash' ) ) ) {
				$args[ 'post_status' ] = $_GET[ 'post_status' ];
			}
			if( isset( $_GET[ $this->slug ] ) && $_GET[ $this->slug ] ) {
				$args[ 'tax_query' ] = array(
					array(
						'taxonomy' => $this->slug, 'field' => 'id', 'terms' => array( $_GET[ $this->slug ] ),
					),
				);
			}
			$this->photos = new WP_Query( $args );
			require_once get_template_directory() . '/core/tmpl/admin/gallery_grid.php';
		}
		
		public function on_load_settings_page() {
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
			
			add_meta_box( 'wt_gallery_main', _x( 'Main settings', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_settings_main',
			), $this->pagesettings, 'normal', 'high' );
		}
		
		public function on_show_settings_page() {
			if( isset( $_POST[ 'submit' ] ) ) {
				$this->save_settings();
			}
			if( file_exists( get_template_directory() . '/core/tmpl/admin/' . $this->pageslug . '.php' ) ) {
				require_once get_template_directory() . '/core/tmpl/admin/' . $this->pageslug . '.php';
			}
		}
		
		private function save_settings() {
			$valid = array();
			if( isset( $_POST[ 'description' ] ) ) {
				$valid[ 'description' ] = wp_kses_post( $_POST[ 'description' ] );
			}
			if( isset( $_POST[ 'display_type' ] ) && in_array( $_POST[ 'display_type' ], array( '', 'gallery' ) ) ) {
				$valid[ 'display_type' ] = $_POST[ 'display_type' ];
			}
			update_option( 'wt_gallery_settings', $valid );
		}
		
		public function add_meta_box_settings_main() {
			do_settings_sections( 'wt_gallery_main' );
		}
		
		public function gallery_settings() {
			add_settings_section( 'wt_gallery_main', '', array( &$this, 'section_main' ), 'wt_gallery_main' );
			
			add_settings_field( 'display_type', _x( 'Select display type', 'Label for field', 'walnut' ),
				array( &$this, 'field_display_type' ), 'wt_gallery_main', 'wt_gallery_main' );
			add_settings_field( 'description', _x( 'Gallery page description', 'Label for field', 'walnut' ),
				array( &$this, 'field_description' ), 'wt_gallery_main', 'wt_gallery_main' );
			
			register_setting( 'wt_catalog_settings', 'display_type' );
			register_setting( 'wt_gallery_settings', 'description' );
			
			register_setting( 'wt_gallery_settings', 'wt_gallery_settings' );
		}
		
		public function section_main() {
		}
		
		private function get_template( $section, $setting, $data ) {
			if( file_exists( get_template_directory() . '/core/tmpl/metaboxes/wt_gallery_settings/' . $section . '/' .
				$setting . '.php' ) ) {
				include get_template_directory() . '/core/tmpl/metaboxes/wt_gallery_settings/' . $section . '/' .
					$setting . '.php';
			}
		}
		
		private function get_setting( $name ) {
			$options = get_option( 'wt_gallery_settings' );
			if( isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}
			
			return false;
		}
		
		public function field_display_type() {
			$this->get_template( 'main', 'display_type', $this->get_setting( 'display_type' ) );
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
					'title' => _x( 'Edit Gallery Settings', 'Name of admin bar menu', 'walnut' ),
					'href' => admin_url( 'edit.php?post_type=' . $this->post_type . '&page=' . $this->pageslug ),
				) );
			}
			
			if( is_admin() && get_current_screen()->base == $this->post_type . '_page_' . $this->pageslug ) {
				$admin_bar->add_menu( array(
					'id' => 'wp-admin-bar-edit',
					'title' => _x( 'View Gallery Page', 'Name of admin bar menu', 'walnut' ),
					'href' => get_post_type_archive_link( $this->post_type ),
				) );
			}
		}
		
		function register_scripts() {
			$options = get_option( 'wt_gallery_settings' );
			if( isset( $options[ 'display_type' ] ) && $options[ 'display_type' ] == 'gallery' ) {
				wp_register_script( 'gallery.js', get_template_directory_uri() . '/core/tmpl/js/gallery.js', array(
					'jquery', 'jquery.fancybox.min',
				), '1.1.0' );
				wp_enqueue_script( 'gallery.js' );
			}
		}
		
	}