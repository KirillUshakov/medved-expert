<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	class WT_Breadcrumbs {
		
		private $breadcrumbs = array();
		
		private static $instance = null;
		
		private $post_types = array(
			'post',
			'page',
			'attachment',
			'revision',
			'nav_menu_item',
			'custom_css',
			'customize_changeset',
		);
		
		public static function instance() {
			if( is_null( self::$instance ) ) {
				self::$instance = new WT_Breadcrumbs();
			}
			
			return self::$instance;
		}
		
		private function __construct() {
			add_filter( 'template_redirect', array( &$this, 'generate_breadcrumbs' ) );
		}
		
		private function add_breadcrumb( $type, $text, $link = '' ) {
			$data = new stdClass();
			$data->type = $type;
			$data->text = $text;
			$data->link = $link;
			$this->breadcrumbs[$type] = $data;
		}
		
		public function generate_breadcrumbs() {
			$this->add_breadcrumb( 'home', _x( 'Home', 'Text of breadcrumbs link', 'walnut' ), home_url() );
			
			if( $_SERVER['REQUEST_URI'] != '/' ) {
				if( is_search() ) {
					$this->search();
				} elseif( is_tag() ) {
					$this->tag();
				} elseif( is_category() ) {
					$this->categories();
				} elseif( is_archive() ) {
					$this->archive();
					if( is_tax() ) {
						$this->terms();
					}
				} elseif( is_page() ) {
					$this->pages();
				} elseif( !is_404() ) {
					$this->archive();
					$this->singular();
				}
			}
			
			$this->breadcrumbs = apply_filters( 'wt_breadcrumbs_generate_before', $this->breadcrumbs );
		}
		
		private function search() {
			$this->add_breadcrumb( 'search',
				sprintf( _x( 'Search: %s', 'Search breadcrumb', 'walnut' ), get_search_query() ) );
		}
		
		private function tag() {
			$tag = get_queried_object();
			if( $tag ) {
				$this->add_breadcrumb( 'tag-' . $tag->slug, sprintf( _x( 'Tag: %s', 'Tag breadcrumb', 'walnut' ), $tag->name ),
					get_tag_link( $tag->term_id ) );
			}
		}
		
		private function categories() {
			//Get current category and parent categories links
			$category[] = get_category( get_query_var( 'cat' ) );
			$cats = wt_get_parent_categories( $category );
			$cats = array_reverse( $cats );
			foreach( $cats as $i => $cat ) {
				$this->add_breadcrumb( 'category-' . $cat->slug, $cat->name, get_category_link( $cat->term_id ) );
			}
		}
		
		private function archive() {
			//Add post type archive link
			$post_type_slug = get_post_type() ? get_post_type() : get_query_var( 'post_type' );
			if( !in_array( $post_type_slug, $this->post_types ) ) {
				$taxonomy_slug = $this->get_taxonomy_slug( $post_type_slug );
				$taxonomy = get_taxonomy( $taxonomy_slug );
				if( !$taxonomy || ( $taxonomy && !wt_options( 'remove_slug_' .
				                                              str_replace( '%', '', $taxonomy->rewrite['slug'] ) ) ) ) {
					$post_type = get_post_type_object( $post_type_slug );
					$this->add_breadcrumb( 'archive-' . $post_type->name,
						isset( $post_type->labels->menu_name ) ? $post_type->labels->menu_name : $post_type->name,
						get_post_type_archive_link( $post_type_slug ) );
				}
			}
		}
		
		private function terms() {
			//Add taxonomy terms links
			$taxonomy_slug = get_query_var( 'taxonomy' );
			$term_slug = get_query_var( 'term' );
			$term = get_term_by( 'slug', $term_slug, $taxonomy_slug );
			if( $term ) {
				$terms = wt_get_parent_terms( $term, $taxonomy_slug );
				$terms = array_reverse( $terms );
				foreach( $terms as $i => $term ) {
					$this->add_breadcrumb( 'term-' . $term->slug, $term->name, get_term_link( $term->term_id ) );
				}
			}
		}
		
		private function pages() {
			//Add parent pages links
			$items = get_ancestors( get_post()->ID, 'page' );
			if( $items ) {
				$items = array_reverse( $items );
				foreach( $items as $item ) {
					$this->add_breadcrumb( 'page-' . get_post_field( 'post_name', $item ), get_the_title( $item ),
						get_permalink( $item ) );
				}
			}
			
			//Add current page link
			$this->add_breadcrumb( get_post_field( 'post_name' ), get_the_title(), get_permalink() );
		}
		
		private function singular() {
			if( !get_post() ) {
				return;
			}
			$post_type_slug = get_post_type();
			if( !in_array( $post_type_slug, $this->post_types ) ) {
				//Add taxonomy terms links
				$taxonomy_slug = $this->get_taxonomy_slug( $post_type_slug );
				$terms = wp_get_post_terms( get_post()->ID, $taxonomy_slug );
				if( $terms && $terms[0] ) {
					$terms = wt_get_parent_terms( $terms[0], $taxonomy_slug );
				}
				$terms = array_reverse( $terms );
				foreach( $terms as $term ) {
					$this->add_breadcrumb( 'term-' . $term->slug, $term->name,
						get_term_link( $term->term_id, $taxonomy_slug ) );
				}
			}
			
			//Add categories links
			$category = get_the_category();
			if( $category ) {
				$cats = wt_get_parent_categories( $category );
				if( $cats ) {
					$cats = array_reverse( $cats );
					foreach( $cats as $cat ) {
						$this->add_breadcrumb( 'category-' . $cat->slug, $cat->name,
							get_category_link( $cat->term_id ) );
					}
				}
			}
			
			//Add parent posts links
			$ancestors = get_post_ancestors( get_post()->ID );
			if( $ancestors ) {
				$ancestors = array_reverse( $ancestors );
				foreach( $ancestors as $item ) {
					$this->add_breadcrumb( 'page-' . get_post_field( 'post_name', $item ), get_the_title( $item ),
						get_permalink( $item ) );
				}
			}
			
			//Add current post link
			$this->add_breadcrumb( 'singular-' . get_post_field( 'post_name' ), get_the_title(), get_permalink() );
		}
		
		private function get_taxonomy_slug( $post_type ) {
			//Finding post types with taxonomies
			if( !in_array( $post_type, $this->post_types ) ) {
				$taxonomies = get_object_taxonomies( $post_type );
				if( $taxonomies && is_array( $taxonomies ) ) {
					return array_pop( $taxonomies );
				}
			}
			$taxonomies = array(
				'wt_element' => 'wt_catalog',
				'wt_photo' => 'wt_gallery',
				'wt_case' => 'wt_portfolio',
			);
			if( isset( $taxonomies[$post_type] ) ) {
				return $taxonomies[$post_type];
			}
			
			return false;
		}
		
		private function get_template( $name, $data = null ) {
			if( file_exists( get_template_directory() . '/core/tmpl/wt_breadcrumbs/' . $name . '.php' ) ) {
				include get_template_directory() . '/core/tmpl/wt_breadcrumbs/' . $name . '.php';
			}
			
			return null;
		}
		
		public function links( $args = array(), $echo = true ) {
			if( !$echo ) {
				return $this->breadcrumbs;
			}
			
			$defaults = array( 'class' => 'breadcrumbs', 'separator' => false );
			$args = $args + $defaults;
			
			$count = count( $this->breadcrumbs );
			if( $count ) {
				$args['breadcrumbs'] = $this->breadcrumbs;
				$this->get_template( 'list', $args );
				
				return true;
			}
			
			return false;
		}
		
	}