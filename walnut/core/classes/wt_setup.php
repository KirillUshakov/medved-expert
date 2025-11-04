<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Setup {
		
		public function __construct() {
			//Setup theme
			add_action( 'after_setup_theme', array( &$this, 'setup_theme' ) );
			
			//Add extra libraries
			add_action( 'init', array( &$this, 'add_admin_theme_libraries' ) );
			
			//Remove link from mediafile
			add_action( 'admin_init', array( &$this, 'remove_media_link' ), 10 );
			
			//Add new formats for mediafiles
			add_filter( 'upload_mimes', array( &$this, 'add_media_formats' ) );
			
			//Fix SVG files sizes
			add_filter( 'image_downsize', array( &$this, 'fix_svg_sizes' ), 10, 2 );
			
			//Add styles and scripts to frontend
			add_action( 'wp_enqueue_scripts', array( &$this, 'add_styles_scripts' ) );
			
			//Add custom post types to query
			add_action( 'pre_get_posts', array( &$this, 'parse_request' ) );
		}
		
		public function setup_theme() {
			//Load text domain walnut
			load_theme_textdomain( 'walnut', get_template_directory() . '/languages' );
			
			/**
			 * Add support post thumbnails
			 * add_image_size( $width, $height, $crop = false ) - presetting sizes for required thumbnails
			 */
			add_theme_support( 'post-thumbnails' );
			
			/**
			 * Support post formats
			 * It can be used as a subsidiary subject
			 * It not used in the parent theme
			 */
			/*add_theme_support( 'post-formats',
				array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );*/
			
			//Support the background through a visual interface editing site
			//add_theme_support( 'custom-background' );
			
			//Support the background image in the header through the visual interface editing site
			//add_theme_support( 'custom-header' );
			
			//Support change the logo through a visual interface editing site
			//add_theme_support( 'custom-logo' );
			
			//Support change title tag through a visual interface editing site
			add_theme_support( 'title-tag' );
			
			//Support Plugin woocommerce
			add_theme_support( 'woocommerce' );
			
			//Add theme locations
			register_nav_menus( array(
				'header_menu' => __( 'Header Menu', 'walnut' ), 'footer_menu' => __( 'Footer Menu', 'walnut' ),
			) );
			
			//Register sidebar for widgets
			if( function_exists( 'register_sidebar' ) ) {
				$args = array(
					'id' => 'default-sidebar', 'name' => _x( 'Standard Sidebar', 'Name of sidebar', 'walnut' ),
					'before_widget' => '<div class="sidebar-widget">', 'after_widget' => '</div>',
					'before_title' => '<div class="title">', 'after_title' => '</div>',
				);
				register_sidebar( $args );
			}
			
			//Add theme settings
			if( is_admin() ) {
				get_template_part( 'core/classes/wt_settings' );
				$theme_page = new WT_Settings();
				
				add_action( 'admin_enqueue_scripts', array( &$this, 'add_admin_theme_scripts' ) );
			}
			
			//Move all scripts to footer
			remove_action( 'wp_head', 'wp_print_styles' );
			add_action( 'wp_footer', 'wp_print_styles', 5 );
			
			remove_action( 'wp_head', 'wp_print_scripts' );
			remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
			remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
			add_action( 'wp_footer', 'wp_print_scripts', 5 );
			add_action( 'wp_footer', 'wp_enqueue_scripts', 5 );
			add_action( 'wp_footer', 'wp_print_head_scripts', 5 );
		}
		
		//Add scripts in admin panel
		public function add_admin_theme_scripts() {
			wp_register_style( 'admin.css', get_template_directory_uri() . '/core/tmpl/css/admin.css' );
			wp_enqueue_style( 'admin.css' );
			
			wp_register_script( 'admin.js', get_template_directory_uri() . '/core/tmpl/js/admin.js',
				array( 'jquery' ) );
			wp_enqueue_script( 'admin.js' );
			wp_localize_script( 'admin.js', 'dataTheme', array(
				'same_tab' => _x( 'same tab', 'Label of link', 'walnut' ),
				'new_tab' => _x( 'new tab', 'Label of link', 'walnut' ),
				'link_opens' => _x( 'Link opens in', 'Label of link', 'walnut' ),
			) );
		}
		
		public function add_admin_theme_libraries() {
			add_thickbox();
		}
		
		public function remove_media_link() {
			$image_set = get_option( 'image_default_link_type' );
			if( $image_set !== 'none' ) {
				update_option( 'image_default_link_type', 'none' );
			}
		}
		
		public function add_media_formats( $mimes ) {
			$mimes[ 'svg' ] = 'image/svg+xml';
			
			return $mimes;
		}
		
		public function fix_svg_sizes( $out, $id ) {
			$image_url = wp_get_attachment_url( $id );
			$file_ext = pathinfo( $image_url, PATHINFO_EXTENSION );
			
			if( 'svg' !== $file_ext ) {
				return false;
			}
			
			return array( $image_url, null, null, false );
		}
		
		public function add_styles_scripts() {
			$options = get_option( 'wt_settings' );
			
			$dependencies = array( 'jquery' );
			
			//Include Fancybox 3
			if( isset( $options[ 'enable_fancybox' ] ) && $options[ 'enable_fancybox' ] ) {
				wp_register_style( 'jquery.fancybox.min',
					get_template_directory_uri() . '/core/tmpl/css/jquery.fancybox.min.css' );
				wp_enqueue_style( 'jquery.fancybox.min' );
				
				wp_register_script( 'jquery.fancybox.min',
					get_template_directory_uri() . '/core/tmpl/js/jquery.fancybox.min.js',
					array( 'jquery' ) );
				wp_enqueue_script( 'jquery.fancybox.min' );
				$dependencies[] = 'jquery.fancybox.min';
			}
			
			//Include Owl Carousel
			if( isset( $options[ 'enable_owl_carousel' ] ) && $options[ 'enable_owl_carousel' ] ) {
				wp_register_style( 'owl.carousel.min',
					get_template_directory_uri() . '/core/tmpl/libraries/owlcarousel/owl.carousel.min.css' );
				wp_enqueue_style( 'owl.carousel.min' );
				
				wp_register_script( 'owl.carousel.min',
					get_template_directory_uri() . '/core/tmpl/libraries/owlcarousel/owl.carousel.min.js',
					array( 'jquery' ) );
				wp_enqueue_script( 'owl.carousel.min' );
				$dependencies[] = 'owl.carousel.min';
			}
			
			//Include The Modal Library
			if( isset( $options[ 'enable_the_modal' ] ) && $options[ 'enable_the_modal' ] ) {
				wp_register_style( 'the-modal.min', get_template_directory_uri() . '/core/tmpl/css/the-modal.min.css' );
				wp_enqueue_style( 'the-modal.min' );
				
				wp_register_script( 'jquery.the-modal.min',
					get_template_directory_uri() . '/core/tmpl/js/jquery.the-modal.min.js', array( 'jquery' ) );
				wp_enqueue_script( 'jquery.the-modal.min' );
				$dependencies[] = 'jquery.the-modal.min';
			}
			
			//Include ScrollTo library
			if( isset( $options[ 'enable_scrollto' ] ) && $options[ 'enable_scrollto' ] ) {
				wp_register_script( 'scrollto.js', get_template_directory_uri() . '/core/tmpl/js/scrollto.js',
					array( 'jquery' ) );
				wp_enqueue_script( 'scrollto.js' );
				$dependencies[] = 'scrollto.js';
			}
			
			//Add base JS
			wp_register_script( 'base.js', get_template_directory_uri() . '/core/tmpl/js/base.js', $dependencies );
			wp_enqueue_script( 'base.js' );
		}
		
		public function parse_request( $query ) {
			// TODO: set default order for photos
			/*if( get_query_var( 'taxonomy' ) == 'wt_gallery' ) {
				$query->set( 'orderby', array( 'ID' => 'ASC' ) );
			}*/
			if( !$query->is_main_query() ) {
				return;
			}
			if( !isset( $query->query[ 'page' ] ) ) {
				return;
			}
			if( !empty( $query->query[ 'name' ] ) ) {
				$query->set( 'post_type',
					array( 'post', 'page', 'wt_case', 'wt_element', 'wt_photo', 'wt_testimonial' ) );
			}
		}
		
	}