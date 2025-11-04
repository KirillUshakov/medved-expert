<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WM_Blocks {
		
		private static $instance = null;
		
		public $location;
		public $objects = array();
		
		private $options_page = 'option';
		
		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		private function __construct() {
			if( function_exists( 'pll_current_language' ) ) {
				$this->options_page = pll_current_language( 'slug' );
			}
			$this->objects = array( 0 => get_queried_object(), 1 => $this->options_page );
		}
		
		public function blocks( $location, $name = null ) {
			$this->location = $location;
			if( !in_array( $location, array( 'header', 'footer', 'content' ) ) ) {
				return false;
			}
			if( !function_exists( 'have_rows' ) || !function_exists( 'the_row' ) ||
			    !function_exists( 'get_row_layout' ) || !function_exists( 'get_sub_field' ) ||
			    !function_exists( 'the_sub_field' ) ) {
				return false;
			}
			foreach( $this->objects as $obj ) {
				if( $obj && get_field( 'blocks', $obj ) && have_rows( 'blocks', $obj ) ) {
					while( have_rows( 'blocks', $obj ) ) {
						the_row();
						if( !( $obj == $this->options_page && is_front_page() &&
						       get_field( 'blocks-disable-front', $obj ) ) && get_sub_field( 'block-enable', $obj ) &&
						    get_sub_field( 'block-location', $obj ) == $location ) {
							if( $name && get_row_layout() == $name ) {
								get_template_part( 'blocks/' . $name );
								break;
							} else {
								get_template_part( 'blocks/' . get_row_layout() );
							}
						}
					}
				}
			}
			
			return true;
		}
		
		public function header_blocks() {
			$this->objects = array( 0 => $this->options_page, 1 => get_queried_object() );
			
			return $this->blocks( 'header' );
		}
		
		public function footer_blocks() {
			$this->objects = array( 0 => get_queried_object(), 1 => $this->options_page );
			
			return $this->blocks( 'footer' );
		}
		
		public function content_blocks() {
			$this->objects = array( 0 => get_queried_object(), 1 => $this->options_page );
			
			return $this->blocks( 'content' );
		}
		
		public function sidebar_blocks( $name = null ) {
			$this->objects = array( 0 => get_queried_object(), 1 => $this->options_page );
			if( !function_exists( 'have_rows' ) || !function_exists( 'the_row' ) ||
			    !function_exists( 'get_row_layout' ) || !function_exists( 'get_sub_field' ) ) {
				return false;
			}
			foreach( $this->objects as $obj ) {
				if( $obj && get_field( 'sidebar-blocks', $obj ) && have_rows( 'sidebar-blocks', $obj ) ) {
					while( have_rows( 'sidebar-blocks', $obj ) ) {
						the_row();
						if( get_sub_field( 'block-enable', $obj ) ) {
							if( $name && get_row_layout() == $name ) {
								get_template_part( 'sidebar-blocks/' . $name );
								break;
							} else {
								get_template_part( 'sidebar-blocks/' . get_row_layout() );
							}
						}
					}
				}
			}
			
			return true;
		}
		
		public function have_blocks( $location ) {
			if( !in_array( $location, array( 'header', 'footer', 'content' ) ) || !function_exists( 'have_rows' ) ) {
				return false;
			}
			foreach( $this->objects as $obj ) {
				if( have_rows( 'blocks', $obj ) ) {
					while( have_rows( 'blocks', $obj ) ) {
						the_row();
						if( !( $obj == $this->options_page && is_front_page() &&
						       get_field( 'blocks-disable-front', $obj ) ) && get_sub_field( 'block-enable', $obj ) &&
						    get_sub_field( 'block-location', $obj ) == $location ) {
							reset_rows();
							
							return true;
						}
					}
				}
				reset_rows();
			}
			
			return false;
		}
		
		public function have_sidebar_blocks() {
			if( !function_exists( 'have_rows' ) ) {
				return false;
			}
			foreach( $this->objects as $obj ) {
				if( $obj && have_rows( 'sidebar-blocks', $obj ) ) {
					while( have_rows( 'sidebar-blocks', $obj ) ) {
						the_row();
						reset_rows();
						
						return true;
					}
				}
				reset_rows();
			}
			
			return false;
		}
		
		public function container_open( $echo = true ) {
			$container = '';
			if( in_array( $this->location, array( 'header', 'footer' ) ) ) {
				$container = '<div class="container">';
			}
			if( $echo ) {
				echo $container;
			}
			
			return $container;
		}
		
		public function container_close( $echo = true ) {
			$container = '';
			if( in_array( $this->location, array( 'header', 'footer' ) ) ) {
				$container = '</div>';
			}
			if( $echo ) {
				echo $container;
			}
			
			return $container;
		}
		
	}