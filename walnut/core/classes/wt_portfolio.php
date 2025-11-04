<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Portfolio {
		
		public $pagehook;
		public $pageslug = 'portfolio_settings';
		
		private $post_type = 'wt_case';
		private $slug = 'wt_portfolio';
		
		private $rewrite_slug = 'portfolio';
		
		public function __construct() {
			//Register taxonomy Sections
			add_action( 'init', array( &$this, 'register_taxonomy' ) );
			//Register post type Cases
			add_action( 'init', array( &$this, 'register_post_type' ) );
			//Add taxonomy filter to admin page list of cases
			add_action( 'restrict_manage_posts', array( &$this, 'add_taxonomy_filter' ) );
			//Parse query of taxonomy filter
			add_filter( 'parse_query', array( &$this, 'parse_query_filter' ) );
			
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
		}
		
		public function register_taxonomy() {
			$labels = array(
				'name' => _x( 'Sections', 'General name for taxonomy', 'walnut' ),
				'singular_name' => _x( 'Section', 'Single name for taxonomy', 'walnut' ),
				'menu_name' => _x( 'Sections', 'Name of menu', 'walnut' ),
				'search_items' => _x( 'Search Sections', 'Text for searching taxonomy', 'walnut' ),
				'popular_items' => null, 'all_items' => _x( 'All Sections', 'All items of taxonomy', 'walnut' ),
				'edit_item' => _x( 'Edit Section', 'Title for page of editing taxonomy item', 'walnut' ),
				'update_item' => _x( 'Update Section', 'Text for updating taxonomy item', 'walnut' ),
				'add_new_item' => _x( 'Add New Section', 'Text of new taxonomy item', 'walnut' ),
				'view_item' => _x( 'View Section', 'Text for viewing taxonomy item', 'walnut' ),
				'new_item_name' => _x( 'New Section', 'Text for creating taxonomy item', 'walnut' ),
				'separate_items_with_commas' => null,
				'add_or_remove_items' => _x( 'Add or remove sections', 'Text of deleting or creating taxonomy item',
					'walnut' ),
				'choose_from_most_used' => _x( 'Choose from most used sections', 'Text for most used taxonomy items',
					'walnut' ), 'not_found' => _x( 'Not found', 'Text for not founding taxonomy items', 'walnut' ),
			);
			register_taxonomy( $this->slug, array( $this->post_type ), array(
				'labels' => $labels, 'show_tagcloud' => false, 'hierarchical' => true, 'update_count_callback' => '',
				'capabilities' => array(), 'meta_box_cb' => 'post_categories_meta_box', 'sort' => true,
				'show_admin_column' => true, 'query_var' => true, 'has_archive' => true, 'rewrite' => array(
					'slug' => '%' . $this->rewrite_slug . '%', 'hierarchical' => true, 'with_front' => false,
				),
			) );
		}
		
		public function register_post_type() {
			$labels = array(
				'name' => _x( 'Cases', 'General name for post type', 'walnut' ),
				'singular_name' => _x( 'Case', 'Single name for post type', 'walnut' ),
				'add_new' => _x( 'Add New', 'Text for button add a case', 'walnut' ),
				'add_new_item' => _x( 'Add New Case', 'Title for page of adding post', 'walnut' ),
				'edit_item' => _x( 'Edit Case', 'Title for page of editing post', 'walnut' ),
				'new_item' => _x( 'New Case', 'Text of new post', 'walnut' ),
				'view_item' => _x( 'View Case', 'Text for viewing post', 'walnut' ),
				'search_items' => _x( 'Search Cases', 'Text for searching post', 'walnut' ),
				'not_found' => _x( 'No Cases yet', 'Text if no cases', 'walnut' ),
				'not_found_in_trash' => _x( 'No Cases in trash', 'Text if no photos in trash', 'walnut' ),
				'parent_item_colon' => '', 'all_items' => _x( 'Cases', 'Name of menu', 'walnut' ),
				'menu_name' => _x( 'Portfolio', 'Name of menu', 'walnut' ),
			);
			
			register_post_type( $this->post_type, array(
				'labels' => $labels,
				'description' => _x( 'Cases for creating cases page', 'Description of post type', 'walnut' ),
				'public' => true, 'publicly_queryable' => true, 'show_ui' => true, 'query_var' => true,
				'rewrite' => array(
					'slug' => $this->rewrite_slug, 'hierarchical' => true, 'with_front' => false,
				), 'capability_type' => 'post', 'has_archive' => true, 'hierarchical' => true, 'menu_position' => 23,
				'menu_icon' => 'dashicons-portfolio',
				'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail', 'page-attributes' ),
				'taxonomies' => array( $this->slug ),
			) );
		}
		
		function add_taxonomy_filter( $post_type ) {
			global $wp_query;
			if( $post_type == $this->post_type ) {
				$term = isset( $wp_query->query[ $this->slug ] ) ? $wp_query->query[ $this->slug ] : '';
				wp_dropdown_categories( array(
					'show_option_all' => _x( 'All Sections', 'All items of taxonomy', 'walnut' ),
					'taxonomy' => $this->slug, 'name' => $this->slug, 'orderby' => 'name', 'selected' => $term,
					'hierarchical' => true, 'depth' => 5, 'show_count' => true, 'hide_empty' => false,
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
			if( isset( $options[ 'remove_slug_portfolio' ] ) && $options[ 'remove_slug_portfolio' ] ) {
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
			if( isset( $options[ 'remove_slug_portfolio' ] ) && $options[ 'remove_slug_portfolio' ] ) {
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
			global $wp_version;
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
			
			if( isset( $options[ 'remove_slug_portfolio' ] ) && $options[ 'remove_slug_portfolio' ] ) {
				foreach( $terms as $term ) {
					$taxonomy_nicename = $term->slug;
					
					if( $term->parent == $term->term_ID ) {
						$term->parent = 0;
					} elseif( $term->parent != 0 ) {
						if( $wp_version >= 4.8 ) {
							$taxonomy_nicename = get_term_parents_list( $term->parent, $this->slug,
									array( 'format' => 'slug', 'link' => false ) ) . $taxonomy_nicename;
						} else {
							$taxonomy_nicename =
								get_category_parents( $term->parent, false, '/', true ) . $taxonomy_nicename;
						}
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
						if( $wp_version >= 4.8 ) {
							$taxonomy_nicename = get_term_parents_list( $term->parent, $this->slug,
									array( 'format' => 'slug', 'link' => false ) ) . $taxonomy_nicename;
						} else {
							$taxonomy_nicename =
								get_category_parents( $term->parent, false, '/', true ) . $taxonomy_nicename;
						}
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
				_x( 'Portfolio settings', 'Title of settings page', 'walnut' ),
				_x( 'Settings', 'Name of submenu page', 'walnut' ), 'manage_options', $this->pageslug,
				array( &$this, 'on_show_settings_page' ) );
			add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_settings_page' ) );
		}
		
		public function on_load_settings_page() {
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
			
			add_meta_box( 'wt_portfolio_main', _x( 'Main settings', 'Title for meta box', 'walnut' ), array(
				&$this, 'add_meta_box_settings_main',
			), $this->pagehook, 'normal', 'high' );
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
			unset( $_POST[ 'option_page' ], $_POST[ '_wpnonce' ], $_POST[ '_wp_http_referer' ], $_POST[ 'submit' ] );
			$valid = array();
			foreach( $_POST as $key => $value ) {
				if( $key == 'description' ) {
					$valid[ $key ] = wp_kses_post( $value );
				}
			}
			update_option( 'wt_portfolio_settings', $valid );
		}
		
		public function add_meta_box_settings_main() {
			do_settings_sections( 'wt_portfolio_main' );
		}
		
		public function portfolio_settings() {
			add_settings_section( 'wt_portfolio_main', '', array( &$this, 'section_main' ), 'wt_portfolio_main' );
			
			add_settings_field( 'description', _x( 'Portfolio page description', 'Label for field', 'walnut' ),
				array( &$this, 'field_description' ), 'wt_portfolio_main', 'wt_portfolio_main' );
			
			register_setting( 'wt_portfolio_settings', 'description' );
			
			register_setting( 'wt_portfolio_settings', 'wt_portfolio_settings' );
		}
		
		public function section_main() {
		}
		
		private function get_template( $section, $setting, $data ) {
			if( file_exists( get_template_directory() . '/core/tmpl/metaboxes/wt_portfolio_settings/' . $section . '/' .
				$setting . '.php' ) ) {
				include get_template_directory() . '/core/tmpl/metaboxes/wt_portfolio_settings/' . $section . '/' .
					$setting . '.php';
			}
		}
		
		private function get_setting( $name ) {
			$options = get_option( 'wt_portfolio_settings' );
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
					'title' => _x( 'Edit Portfolio Settings', 'Name of admin bar menu', 'walnut' ),
					'href' => admin_url( 'edit.php?post_type=' . $this->post_type . '&page=' . $this->pageslug ),
				) );
			}
			
			if( is_admin() && get_current_screen()->base == $this->post_type . '_page_' . $this->pageslug ) {
				$admin_bar->add_menu( array(
					'id' => 'wp-admin-bar-edit',
					'title' => _x( 'View Portfolio Page', 'Name of admin bar menu', 'walnut' ),
					'href' => get_post_type_archive_link( $this->post_type ),
				) );
			}
		}
		
	}