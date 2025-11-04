<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Settings {
		
		public $pagehook;
		
		public function __construct() {
			//add filter for WordPress 2.8 changed backend box system !
			add_filter( 'screen_layout_columns', array( &$this, 'on_screen_layout_columns' ), 10, 2 );
			//register callback for admin menu  setup
			add_action( 'admin_menu', array( &$this, 'on_admin_menu' ) );
			//include theme settings call functions
			add_action( 'admin_init', array( &$this, 'theme_settings' ) );
			//add admin scripts
			add_action( 'admin_print_footer_scripts', array( &$this, 'admin_scripts' ) );
			
			if( isset( $_POST ) && $_POST ) {
				add_action( 'admin_notices', array( &$this, 'save_success' ) );
			}
		}
		
		//for WordPress 2.8 we have to tell, that we support 2 columns !
		public function on_screen_layout_columns( $columns, $screen ) {
			if( $screen == $this->pagehook ) {
				$columns[ $this->pagehook ] = 2;
			}
			
			return $columns;
		}
		
		//extend the admin menu
		public function on_admin_menu() {
			//add our own option page, you can also add it to different sections or use your own one
			$this->pagehook = add_menu_page( _x( 'Theme settings', 'Tag <title> for Theme settings page', 'walnut' ),
				_x( 'Theme settings', 'Text of menu item', 'walnut' ), 'manage_options',
				//Возможность пользователя необходимая, чтобы он увидел эту страницу меню
				'wt_settings', //Идентификатор меню (slug), по которому можно обращаться к меню. Должен быть уникальным
				array( &$this, 'on_show_page' ), //Callback функция, выводящая HTML код страницы пункта меню
				'dashicons-screenoptions', '80.000005' );
			//register  callback gets call prior your own page gets rendered
			add_action( 'load-' . $this->pagehook, array( &$this, 'on_load_page' ) );
		}
		
		public function admin_scripts() {
			//Fix for pages that don't have editors
			if( !class_exists( '_WP_Editors' ) and ( !defined( 'DOING_AJAX' ) or !DOING_AJAX ) ) {
				require_once ABSPATH . WPINC . '/class-wp-editor.php';
				wp_print_styles( 'editor-buttons' );
				_WP_Editors::wp_link_dialog();
			}
		}
		
		//will be executed if wordpress core detects this page has to be rendered
		public function on_load_page() {
			//ensure, that the needed javascript been loaded to allow drag/drop, expand/collapse and hide/show of boxes
			wp_enqueue_script( 'common' );
			wp_enqueue_script( 'wp-lists' );
			wp_enqueue_script( 'postbox' );
			wp_enqueue_script( 'wplink' );
			wp_enqueue_script( 'wpdialogs' );
			wp_enqueue_script( 'wpdialogs-popup' );
			wp_enqueue_style( 'wp-jquery-ui-dialog' );
			wp_enqueue_style( 'thickbox' );
			
			//Инициализируем дополнительные блоки. Любой из блоков можно будет включить/выключить в параметрах экрана
			add_meta_box( 'wt_media', _x( 'Media', 'Title for meta box', 'walnut' ),
				array( &$this, 'add_media_meta_box' ), $this->pagehook, 'normal', 'high' );
			add_meta_box( 'wt_info', _x( 'Information', 'Title for meta box', 'walnut' ),
				array( &$this, 'add_info_meta_box' ), $this->pagehook, 'normal', 'high' );
			add_meta_box( 'wt_social', _x( 'Social networks', 'Title for meta box', 'walnut' ),
				array( &$this, 'add_social_meta_box' ), $this->pagehook, 'normal', 'high' );
			add_meta_box( 'wt_extra', _x( 'Additional settings', 'Title for meta box', 'walnut' ),
				array( &$this, 'add_extra_meta_box' ), $this->pagehook, 'normal', 'high' );
			add_meta_box( 'wt_permalink', _x( 'Permalink settings', 'Title for meta box', 'walnut' ),
				array( &$this, 'add_permalink_meta_box' ), $this->pagehook, 'normal', 'high' );
		}
		
		/*
		 * Функция отображения страницы настроек
		 */
		public function on_show_page() {
			if( isset( $_POST[ 'submit' ] ) ) {
				$this->save_settings();
			}
			if( !did_action( 'wp_enqueue_media' ) ) {
				wp_enqueue_media();
			}
			//Подключаем шаблон не через get_template_part, так как в шаблоне необходима переменная $this
			if( file_exists( get_template_directory() . '/core/tmpl/admin/theme_settings.php' ) ) {
				require_once get_template_directory() . '/core/tmpl/admin/theme_settings.php';
			}
		}
		
		/**
		 * Функция проверки и сохранения значения настроек
		 */
		public function save_settings() {
			unset( $_POST[ 'option_page' ], $_POST[ '_wpnonce' ], $_POST[ '_wp_http_referer' ], $_POST[ 'submit' ] );
			$valid = array();
			foreach( $_POST as $key => $item ) {
				if( in_array( $key, array( 'phone', 'phone_add', 'email' ) ) && is_array( $item ) &&
					isset( $item[ 'title' ] ) && isset( $item[ 'href' ] ) ) {
					$valid[ $key ][ 'title' ] = wp_kses_post( $item[ 'title' ] );
					$valid[ $key ][ 'href' ] = esc_url( $item[ 'href' ] );
					$valid[ $key ][ 'target' ] = isset( $item[ 'target' ] ) && $item[ 'target' ] ? true : false;
				} elseif( is_array( $item ) && isset( $item[ 'link' ] ) ) {
					if( isset( $item[ 'icon' ] ) ) {
						$valid[ $key ][ 'icon' ] = (int)$item[ 'icon' ];
					}
					$valid[ $key ][ 'link' ] = esc_url( $item[ 'link' ] );
				} elseif( is_string( $item ) &&
					in_array( $key, array( 'address', 'distance', 'worktime', 'copyright', 'weblink' ) ) ) {
					$valid[ $key ] = wp_kses_post( $item );
				} else {
					$valid[ $key ] = trim( $item );
				}
			}
			update_option( 'wt_settings', $valid );
			
			flush_rewrite_rules();
		}
		
		public function save_success() {
			$screen = get_current_screen();
			if( $screen && $screen->parent_base == 'wt_settings' ) {
				$class = 'notice notice-success is-dismissible';
				$message = __( 'Saved successfully', 'walnut' );
				
				printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
			}
		}
		
		/*
		 * Функции вывода дополнительных блоков
		 */
		public function add_media_meta_box() {
			do_settings_sections( 'wt_media' );
		}
		
		public function add_info_meta_box() {
			do_settings_sections( 'wt_info' );
		}
		
		public function add_social_meta_box() {
			do_settings_sections( 'wt_social' );
		}
		
		public function add_extra_meta_box() {
			do_settings_sections( 'wt_extra' );
		}
		
		public function add_permalink_meta_box() {
			do_settings_sections( 'wt_permalink' );
		}
		
		public function theme_settings() {
			//Создаём секцию медиа-настроек
			add_settings_section( 'wt_media', _x( 'Select logos and favicon', 'Help text for meta box', 'walnut' ),
				array( &$this, 'section_media' ), 'wt_media' );
			
			//Создаём поля медиа-настроек
			add_settings_field( 'header_logo', _x( 'Header Logo', 'Label for field', 'walnut' ),
				array( &$this, 'field_header_logo' ), 'wt_media', 'wt_media' );
			add_settings_field( 'footer_logo', _x( 'Footer Logo', 'Label for field', 'walnut' ),
				array( &$this, 'field_footer_logo' ), 'wt_media', 'wt_media' );
			add_settings_field( 'favicon', _x( 'Favicon', 'Label for field', 'walnut' ),
				array( &$this, 'field_favicon' ), 'wt_media', 'wt_media' );
			
			register_setting( 'wt_settings', 'header_logo' );
			register_setting( 'wt_settings', 'footer_logo' );
			register_setting( 'wt_settings', 'favicon' );
			
			//Создаём секцию настроек информации
			add_settings_section( 'wt_info', _x( 'Specify the main information', 'Help text for meta box', 'walnut' ),
				array( &$this, 'section_info' ), 'wt_info' );
			
			//Создаём поля настроек информации
			add_settings_field( 'phone', _x( 'Phone', 'Label for field', 'walnut' ), array( &$this, 'field_phone' ),
				'wt_info', 'wt_info' );
			add_settings_field( 'phone_add', _x( 'Additional phone', 'Label for field', 'walnut' ),
				array( &$this, 'field_phone_add' ), 'wt_info', 'wt_info' );
			add_settings_field( 'email', _x( 'E-mail', 'Label for field', 'walnut' ), array( &$this, 'field_email' ),
				'wt_info', 'wt_info' );
			add_settings_field( 'address', _x( 'Address', 'Label for field', 'walnut' ),
				array( &$this, 'field_address' ), 'wt_info', 'wt_info' );
			add_settings_field( 'distance', _x( 'Distance', 'Label for field', 'walnut' ),
				array( &$this, 'field_distance' ), 'wt_info', 'wt_info' );
			add_settings_field( 'worktime', _x( 'Work time', 'Label for field', 'walnut' ),
				array( &$this, 'field_worktime' ), 'wt_info', 'wt_info' );
			add_settings_field( 'copyright', _x( 'Copyright', 'Label for field', 'walnut' ),
				array( &$this, 'field_copyright' ), 'wt_info', 'wt_info' );
			add_settings_field( 'weblink', _x( 'Link to web studio', 'Label for field', 'walnut' ),
				array( &$this, 'field_weblink' ), 'wt_info', 'wt_info' );
			
			//Регистрируем поля настроек информации внутри опции wt_settings
			register_setting( 'wt_settings', 'phone' );
			register_setting( 'wt_settings', 'phone_add' );
			register_setting( 'wt_settings', 'email' );
			register_setting( 'wt_settings', 'address' );
			register_setting( 'wt_settings', 'distance' );
			register_setting( 'wt_settings', 'worktime' );
			register_setting( 'wt_settings', 'copyright' );
			register_setting( 'wt_settings', 'weblink' );
			
			//Создаём секцию социальных сетей
			add_settings_section( 'wt_social',
				_x( 'Specify links to your existing groups / pages in social networks (one link to each social network).',
					'Help text for meta box', 'walnut' ), array( &$this, 'section_social' ), 'wt_social' );
			
			//Создаём поля ссылок на соц. сети
			add_settings_field( 'vk', _x( 'Vkontakte', 'Label for field', 'walnut' ), array( &$this, 'field_vk' ),
				'wt_social', 'wt_social' );
			add_settings_field( 'fb', _x( 'Facebook', 'Label for field', 'walnut' ), array( &$this, 'field_fb' ),
				'wt_social', 'wt_social' );
			add_settings_field( 'instagram', _x( 'Instagram', 'Label for field', 'walnut' ),
				array( &$this, 'field_instagram' ), 'wt_social', 'wt_social' );
			add_settings_field( 'gplus', _x( 'Google+', 'Label for field', 'walnut' ), array( &$this, 'field_gplus' ),
				'wt_social', 'wt_social' );
			add_settings_field( 'ok', _x( 'Odnoklassniki', 'Label for field', 'walnut' ), array( &$this, 'field_ok' ),
				'wt_social', 'wt_social' );
			add_settings_field( 'twitter', _x( 'Twitter', 'Label for field', 'walnut' ),
				array( &$this, 'field_twitter' ), 'wt_social', 'wt_social' );
			add_settings_field( 'linkedin', _x( 'LinkedIn', 'Label for field', 'walnut' ),
				array( &$this, 'field_linkedin' ), 'wt_social', 'wt_social' );
			add_settings_field( 'youtube', _x( 'Youtube channel', 'Label for field', 'walnut' ),
				array( &$this, 'field_youtube' ), 'wt_social', 'wt_social' );
			
			//Регистрируем поля ссылок на соц. сети внутри опции wt_settings
			register_setting( 'wt_settings', 'vk' );
			register_setting( 'wt_settings', 'fb' );
			register_setting( 'wt_settings', 'instagram' );
			register_setting( 'wt_settings', 'gplus' );
			register_setting( 'wt_settings', 'ok' );
			register_setting( 'wt_settings', 'twitter' );
			register_setting( 'wt_settings', 'linkedin' );
			register_setting( 'wt_settings', 'youtube' );
			
			//Создаём секцию дополнительных настроек
			add_settings_section( 'wt_extra',
				_x( 'If you do not know the meaning of these settings, do not change it.', 'Help text for meta box',
					'walnut' ), array( &$this, 'section_extra' ), 'wt_extra' );
			
			//Создаём поля дополнительных настроек
			add_settings_field( 'code_map',
				_x( 'Map code with the address (Google maps, Yandex maps, etc.)', 'Label for field', 'walnut' ),
				array( &$this, 'field_code_map' ), 'wt_extra', 'wt_extra' );
			add_settings_field( 'code_counter', _x( 'Counter Code', 'Label for field', 'walnut' ),
				array( &$this, 'field_code_counter' ), 'wt_extra', 'wt_extra' );
			add_settings_field( 'enable_fancybox', _x( 'Fancybox', 'Label for field', 'walnut' ),
				array( &$this, 'field_enable_fancybox' ), 'wt_extra', 'wt_extra' );
			add_settings_field( 'enable_owl_carousel', _x( 'Owl Carousel', 'Label for field', 'walnut' ),
				array( &$this, 'field_enable_owl_carousel' ), 'wt_extra', 'wt_extra' );
			add_settings_field( 'enable_the_modal', _x( 'The Modal', 'Label for field', 'walnut' ),
				array( &$this, 'field_enable_the_modal' ), 'wt_extra', 'wt_extra' );
			add_settings_field( 'enable_scrollto', _x( 'ScrollTo', 'Label for field', 'walnut' ),
				array( &$this, 'field_enable_scrollto' ), 'wt_extra', 'wt_extra' );
			
			//Регистрируем поля дополнительных настроек внутри опции wt_settings
			register_setting( 'wt_settings', 'code_map' );
			register_setting( 'wt_settings', 'code_counter' );
			register_setting( 'wt_settings', 'enable_fancybox' );
			register_setting( 'wt_settings', 'enable_owl_carousel' );
			register_setting( 'wt_settings', 'enable_the_modal' );
			register_setting( 'wt_settings', 'enable_scrollto' );
			
			//Создаём секцию настроек постоянных ссылок
			add_settings_section( 'wt_permalink',
				_x( 'Permalink settings for theme taxonomies and post types', 'Help text for meta box', 'walnut' ),
				array( &$this, 'section_permalink' ), 'wt_permalink' );
			
			add_settings_field( 'remove_slug_portfolio', _x( 'Portfolio slug', 'Label for field', 'walnut' ),
				array( &$this, 'field_remove_slug_portfolio' ), 'wt_permalink', 'wt_permalink' );
			add_settings_field( 'remove_slug_catalog', _x( 'Catalog slug', 'Label for field', 'walnut' ),
				array( &$this, 'field_remove_slug_catalog' ), 'wt_permalink', 'wt_permalink' );
			add_settings_field( 'remove_slug_gallery', _x( 'Gallery slug', 'Label for field', 'walnut' ),
				array( &$this, 'field_remove_slug_gallery' ), 'wt_permalink', 'wt_permalink' );
			
			register_setting( 'wt_settings', 'remove_slug_portfolio' );
			register_setting( 'wt_settings', 'remove_slug_catalog' );
			register_setting( 'wt_settings', 'remove_slug_gallery' );
			
			//Регистрируем поля настроек
			register_setting( 'wt_settings', 'wt_settings' );
		}
		
		/**
		 * Функция, вызывающаяся описание секции медиа
		 */
		public function section_media() {
		}
		
		/**
		 * Функция, вызывающаяся описание секции информации
		 */
		public function section_info() {
		}
		
		/**
		 * Функция, вызывающаяся описание соц. сетей
		 */
		public function section_social() {
		}
		
		/**
		 * Функция, вызывающаяся описание дополнительных настроек
		 */
		public function section_extra() {
		}
		
		/**
		 * Функция, вызывающаяся описание настроек постоянных ссылок
		 */
		public function section_permalink() {
		}
		
		private function get_template( $section, $setting ) {
			if( file_exists( get_template_directory() . '/core/tmpl/metaboxes/wt_settings/' . $section . '/' .
				$setting . '.php' ) ) {
				$data = $this->get_setting( $setting );
				include get_template_directory() . '/core/tmpl/metaboxes/wt_settings/' . $section . '/' . $setting .
					'.php';
			}
		}
		
		private function get_setting( $name ) {
			$options = get_option( 'wt_settings' );
			if( isset( $options[ $name ] ) ) {
				return $options[ $name ];
			}
			
			return false;
		}
		
		/**
		 * Функции вывода полей основных настроек
		 */
		public function field_header_logo() {
			$this->get_template( 'media', 'header_logo' );
		}
		
		public function field_footer_logo() {
			$this->get_template( 'media', 'footer_logo' );
		}
		
		public function field_favicon() {
			$this->get_template( 'media', 'favicon' );
		}
		
		public function field_phone() {
			$this->get_template( 'info', 'phone' );
		}
		
		public function field_phone_add() {
			$this->get_template( 'info', 'phone_add' );
		}
		
		public function field_email() {
			$this->get_template( 'info', 'email' );
		}
		
		public function field_address() {
			$this->get_template( 'info', 'address' );
		}
		
		public function field_distance() {
			$this->get_template( 'info', 'distance' );
		}
		
		public function field_worktime() {
			$this->get_template( 'info', 'worktime' );
		}
		
		public function field_copyright() {
			$this->get_template( 'info', 'copyright' );
		}
		
		public function field_weblink() {
			$this->get_template( 'info', 'weblink' );
		}
		
		/**
		 * Функции вывода полей настроек социальных сетей
		 */
		public function field_vk() {
			$this->get_template( 'social', 'vk' );
		}
		
		public function field_fb() {
			$this->get_template( 'social', 'fb' );
		}
		
		public function field_instagram() {
			$this->get_template( 'social', 'instagram' );
		}
		
		public function field_gplus() {
			$this->get_template( 'social', 'gplus' );
		}
		
		public function field_ok() {
			$this->get_template( 'social', 'ok' );
		}
		
		public function field_twitter() {
			$this->get_template( 'social', 'twitter' );
		}
		
		public function field_linkedin() {
			$this->get_template( 'social', 'linkedin' );
		}
		
		public function field_youtube() {
			$this->get_template( 'social', 'youtube' );
		}
		
		/**
		 * Функции вывода полей дополнительных полей настроек
		 */
		public function field_code_map() {
			$this->get_template( 'extra', 'code_map' );
		}
		
		public function field_code_counter() {
			$this->get_template( 'extra', 'code_counter' );
		}
		
		public function field_enable_fancybox() {
			$this->get_template( 'extra', 'enable_fancybox' );
		}
		
		public function field_enable_owl_carousel() {
			$this->get_template( 'extra', 'enable_owl_carousel' );
		}
		
		public function field_enable_the_modal() {
			$this->get_template( 'extra', 'enable_the_modal' );
		}
		
		public function field_enable_scrollto() {
			$this->get_template( 'extra', 'enable_scrollto' );
		}
		
		public function field_remove_slug_portfolio() {
			$this->get_template( 'permalink', 'remove_slug_portfolio' );
		}
		
		public function field_remove_slug_catalog() {
			$this->get_template( 'permalink', 'remove_slug_catalog' );
		}
		
		public function field_remove_slug_gallery() {
			$this->get_template( 'permalink', 'remove_slug_gallery' );
		}
		
	}