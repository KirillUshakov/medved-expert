<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Components {
		
		private static $instance = null;
		
		private $social_links = array( 'vk', 'fb', 'instagram', 'gplus', 'ok', 'twitter', 'linkedin', 'youtube' );
		private $share_links = array( 'vk', 'fb', 'ok', 'gplus', 'twitter', 'linkedin' );
		
		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new WT_Components();
			}
			
			return self::$instance;
		}
		
		private function __construct() {
			
		}
		
		private function get_template( $component, $name, $data = null ) {
			if( file_exists( get_template_directory() . '/core/tmpl/wt_components/' . $component . '/' . $name .
				'.php' ) ) {
				include get_template_directory() . '/core/tmpl/wt_components/' . $component . '/' . $name . '.php';
			}
			
			return null;
		}
		
		public function social_links( $args = array() ) {
			$defaults = array(
				'class' => 'social-links',
				'text'  => _x( 'We are in social networks:', 'Additional text for social links', 'walnut' )
			);
			$args = $args + $defaults;
			if( isset( $args['links'] ) ) {
				$links = $this->get_social_links( $args['links'] );
			} else {
				$links = $this->get_social_links();
			}
			if( $links ) {
				$args['links'] = $links;
				$this->get_template( 'social_links', 'links', $args );
			}
		}
		
		public function social_link( $name ) {
			$link = $this->get_social_link( $name );
			if( $link ) {
				$this->get_template( 'social_links', 'link', $link );
			}
		}
		
		public function get_social_links( $links = array() ) {
			if( !$links ) {
				$links = $this->social_links;
			}
			$res = array();
			foreach( $links as $name ) {
				$link = $this->get_social_link( $name );
				if( $link ) {
					$res[] = $link;
				}
			}
			if( $res ) {
				return $res;
			}
			
			return false;
		}
		
		public function get_social_link( $name ) {
			$link = wt_options( $name );
			if( $link && isset( $link['link'] ) && isset( $link['icon'] ) ) {
				return $link;
			}
			
			return false;
		}
		
		public function share_links( $link = null, $text = '', $title = '', $link_text = false, $links = array() ) {
			if( !$links ) {
				$links = $this->share_links;
			}
			$defaults =
				array( 'link' => get_permalink( get_the_ID() ), 'link_text' => false, 'text' => get_the_title() );
			$args = array(
				'links'     => $links, 'link' => $link ? $link : $defaults['link'],
				'text'      => $text ? $text : _x( 'Share in social networks', 'Text for share buttons', 'walnut' ),
				'link_text' => $link_text ? $link_text : $defaults['link_text'],
				'title'     => $title ? $title : $defaults['title']
			);
			$this->get_template( 'share_links', 'links', $args );
		}
		
		public function share_link( $name, $link = null, $title = '', $link_text = false ) {
			$defaults =
				array( 'link' => get_permalink( get_the_ID() ), 'link_text' => false, 'text' => get_the_title() );
			$args = array(
				'link'      => $link ? $link : $defaults['link'],
				'link_text' => $link_text ? $link_text : $defaults['link_text'],
				'title'     => $title ? $title : $defaults['title']
			);
			if( in_array( $name, $this->social_links ) ) {
				$this->get_template( 'share_links', $name, $args );
			}
		}
		
		public function modal_frame_link( $before = '?', $echo = true ) {
			$data = $before . 'KeepThis=true&TB_iframe=true';
			if( $echo ) {
				echo $data;
			}
			
			return $data;
		}
		
		public function modal_frame_class( $echo = true ) {
			$data = 'wt-frame-link thickbox';
			if( $echo ) {
				echo $data;
			}
			
			return $data;
		}
		
	}