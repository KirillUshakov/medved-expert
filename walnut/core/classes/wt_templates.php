<?php
	//avoid direct calls to this file where wp core files not present
	if( !function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
	
	/**
	 * Константы папки темы и папки текущей дочерней темы
	 */
	define( 'WALNUT_PATH', get_template_directory() . DIRECTORY_SEPARATOR );
	define( 'THEME_PATH', get_theme_root() . DIRECTORY_SEPARATOR . get_stylesheet() . DIRECTORY_SEPARATOR );
	
	class WT_Templates {
		
		private $slash = DIRECTORY_SEPARATOR;
		
		public $templates = array();
		
		public function __construct() {
			$this->templates = array(
				'core/tmpl/page/testimonials.php' => _x( 'Testimonials (embed)', 'Template name in theme', 'walnut' ),
				'core/tmpl/page/gallery.php' => _x( 'Gallery (embed)', 'Template name in theme', 'walnut' ),
			);
			
			//Add page templates
			
			// Add a filter to the attributes metabox to inject template into the cache.
			if( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
				// 4.6 and older
				add_filter( 'page_attributes_dropdown_pages_args', array( &$this, 'register_page_templates' ) );
			} else {
				// Add a filter to the wp 4.7 version attributes metabox
				add_filter( 'theme_page_templates', array( &$this, 'add_new_templates' ) );
			}
			// Add a filter to the save post to inject out template into the page cache
			add_filter( 'wp_insert_post_data', array( &$this, 'register_page_templates' ) );
			// Add a filter to the template include to determine if the page has our template assigned and return it's path
			// Checks if the template is assigned to the page
			add_filter( 'template_include', array( &$this, 'view_page_template' ) );
			
			//Return post type template
			add_filter( 'single_template', array( &$this, 'post_type_templates' ) );
			
			//Return category template
			add_filter( 'category_template', array( &$this, 'category_templates' ) );
			
			//Return taxonomy template
			add_filter( 'taxonomy_template', array( &$this, 'taxonomy_templates' ) );
			
			//Return archive template
			//add_filter( 'archive_template', array( &$this, 'archive_templates' ) );
		}
		
		public function register_page_templates( $args ) {
			// Add cache key for theme cache
			$cache_key = 'page_templates-' . md5( get_theme_root() . $this->slash . get_stylesheet() );
			
			// Get page templates
			$templates = wp_get_theme()->get_page_templates();
			if( empty( $templates ) ) {
				$templates = array();
			}
			// Update cache key by deleting
			wp_cache_delete( $cache_key, 'themes' );
			// Add embed page templates
			$templates = array_merge( $templates, $this->templates );
			// Add new templates to WordPress cache
			wp_cache_add( $cache_key, $templates, 'themes', 1800 );
			
			return $args;
		}
		
		public function add_new_templates( $posts_templates ) {
			$posts_templates = array_merge( $posts_templates, $this->templates );
			
			return $posts_templates;
		}
		
		public function view_page_template( $template ) {
			// Get global post
			global $post;
			
			// Return template if post is empty
			if( !$post ) {
				return $template;
			}
			
			// Return default template if we don't have a custom one defined
			if( !isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
				return $template;
			}
			
			$file = get_template_directory() . $this->slash . get_post_meta( $post->ID, '_wp_page_template', true );
			
			// Just to be safe, we check if the file exist first
			if( file_exists( $file ) ) {
				return $file;
			} else {
				echo $file;
			}
			
			// Return template
			return $template;
			
		}
		
		public function post_type_templates( $template ) {
			$post = get_post();
			if( $post->post_type == 'post' ) {
				$dir = 'single';
			} else {
				$dir = $post->post_type;
			}
			$dir_slash = $dir . $this->slash;
			
			/**
			 * Return template in post_type dir finding by post ID
			 * Format: $post_type/ID.php
			 */
			if( file_exists( THEME_PATH . $dir_slash . $post->ID . '.php' ) ) {
				return THEME_PATH . $dir_slash . $post->ID . '.php';
			} elseif( file_exists( WALNUT_PATH . $dir_slash . $post->ID . '.php' ) ) {
				return WALNUT_PATH . $dir_slash . $post->ID . '.php';
			}
			
			/**
			 * Return template in post_type dir finding by terms slugs or term ids
			 * Format: $post_type/term-SLUG.php or $post_type/term-ID.php
			 */
			$taxonomies = get_post_taxonomies( $post );
			if( $taxonomies ) {
				foreach( $taxonomies as $taxonomy ) {
					$terms = wp_get_post_terms( $post->ID, $taxonomy );
					if( $terms && $terms[0] ) {
						$terms = wt_get_parent_terms( $terms[0], $taxonomy );
					}
					if( isset( $terms ) && $terms ) {
						foreach( (array)$terms as $term ) {
							if( file_exists( THEME_PATH . $dir_slash . 'term-' . $term->slug . '.php' ) ) {
								return THEME_PATH . $dir_slash . 'term-' . $term->slug . '.php';
							} elseif( file_exists( WALNUT_PATH . $dir_slash . 'term-' . $term->slug . '.php' ) ) {
								return WALNUT_PATH . $dir_slash . 'term-' . $term->slug . '.php';
							} elseif( file_exists( THEME_PATH . $dir_slash . 'term-' . $term->term_id . '.php' ) ) {
								return THEME_PATH . $dir_slash . 'term-' . $term->term_id . '.php';
							} elseif( file_exists( WALNUT_PATH . $dir_slash . 'term-' . $term->term_id . '.php' ) ) {
								return WALNUT_PATH . $dir_slash . 'term-' . $term->term_id . '.php';
							}
						}
					}
				}
			}
			
			/**
			 * Return template by post_type name finding in post_type dir or theme dir
			 * Format: $post_type/$post_type.php or $post_type.php
			 */
			if( file_exists( THEME_PATH . $dir_slash . $dir . '.php' ) ) {
				return THEME_PATH . $dir_slash . $dir . '.php';
			} elseif( file_exists( WALNUT_PATH . $dir_slash . $dir . '.php' ) ) {
				return WALNUT_PATH . $dir_slash . $dir . '.php';
			} elseif( file_exists( THEME_PATH . $dir . '.php' ) ) {
				return THEME_PATH . $dir . '.php';
			} elseif( file_exists( WALNUT_PATH . $dir . '.php' ) ) {
				return WALNUT_PATH . $dir . '.php';
			}
			
			return $template;
		}
		
		public function category_templates( $template ) {
			$cat = get_query_var( 'cat' );
			$category[] = get_category( $cat );
			$categories = wt_get_parent_categories( $category );
			
			foreach( $categories as $cat ) {
				/**
				 * Return template in category dir finding by category slugs or category ids
				 * Format: category/term-SLUG.php or category/term-ID.php
				 */
				if( file_exists( THEME_PATH . 'category' . $this->slash . $cat->slug . '.php' ) ) {
					return THEME_PATH . 'category' . $this->slash . $cat->slug . '.php';
				} elseif( file_exists( THEME_PATH . 'category' . $this->slash . $cat->term_id . '.php' ) ) {
					return THEME_PATH . 'category' . $this->slash . $cat->term_id . '.php';
				} elseif( file_exists( WALNUT_PATH . 'category' . $this->slash . $cat->slug . '.php' ) ) {
					return WALNUT_PATH . 'category' . $this->slash . $cat->slug . '.php';
				} elseif( file_exists( WALNUT_PATH . 'category' . $this->slash . $cat->term_id . '.php' ) ) {
					return WALNUT_PATH . 'category' . $this->slash . $cat->term_id . '.php';
				}
			}
			
			/**
			 * Return template by category name finding in category dir or theme dir
			 * Format: category/category.php or category.php
			 */
			if( file_exists( THEME_PATH . 'category' . $this->slash . 'category.php' ) ) {
				return THEME_PATH . 'category' . $this->slash . 'category.php';
			} elseif( file_exists( WALNUT_PATH . 'category' . $this->slash . 'category.php' ) ) {
				return WALNUT_PATH . 'category' . $this->slash . 'category.php';
			} elseif( file_exists( THEME_PATH . 'category.php' ) ) {
				return THEME_PATH . 'category.php';
			} elseif( file_exists( WALNUT_PATH . 'category.php' ) ) {
				return WALNUT_PATH . 'category.php';
			}
			
			return $template;
		}
		
		public function taxonomy_templates( $template ) {
			$taxonomy = get_query_var( 'taxonomy' );
			$term_slug = get_query_var( 'term' );
			$term = get_term_by( 'slug', $term_slug, $taxonomy );
			$terms = wt_get_parent_terms( $term, $taxonomy );
			foreach( $terms as $term ) {
				/**
				 * Return template in taxonomy dir finding by terms slugs or term ids
				 * Format: taxonomy/term-SLUG.php or taxonomy/term-ID.php
				 */
				if( file_exists( THEME_PATH . $taxonomy . $this->slash . $term->slug . '.php' ) ) {
					return THEME_PATH . $taxonomy . $this->slash . $term->slug . '.php';
				} elseif( file_exists( THEME_PATH . $taxonomy . $this->slash . $term->term_id . '.php' ) ) {
					return THEME_PATH . $taxonomy . $this->slash . $term->term_id . '.php';
				} elseif( file_exists( WALNUT_PATH . $taxonomy . $this->slash . $term->slug . '.php' ) ) {
					return WALNUT_PATH . $taxonomy . $this->slash . $term->slug . '.php';
				} elseif( file_exists( WALNUT_PATH . $taxonomy . $this->slash . $term->term_id . '.php' ) ) {
					return WALNUT_PATH . $taxonomy . $this->slash . $term->term_id . '.php';
				}
			}
			
			/**
			 * Return template by taxonomy name finding in taxonomy dir or theme dir
			 * Format: $taxonomy/$taxonomy.php or $taxonomy.php
			 */
			if( file_exists( THEME_PATH . $taxonomy . $this->slash . $taxonomy . '.php' ) ) {
				return THEME_PATH . $taxonomy . $this->slash . $taxonomy . '.php';
			} elseif( file_exists( WALNUT_PATH . $taxonomy . $this->slash . $taxonomy . '.php' ) ) {
				return WALNUT_PATH . $taxonomy . $this->slash . $taxonomy . '.php';
			} elseif( file_exists( THEME_PATH . $taxonomy . '.php' ) ) {
				return THEME_PATH . $taxonomy . '.php';
			} elseif( file_exists( WALNUT_PATH . $taxonomy . '.php' ) ) {
				return WALNUT_PATH . $taxonomy . '.php';
			}
			
			return $template;
		}
		
		public function archive_templates( $template ) {
			$taxonomy = get_query_var( 'taxonomy' );
			
			/**
			 * Return template by taxonomy name finding in theme dir
			 * Format: archive-$taxonomy.php
			 */
			if( file_exists( THEME_PATH . 'archive-' . $taxonomy . '.php' ) ) {
				return THEME_PATH . 'archive-' . $taxonomy . '.php';
			} elseif( file_exists( WALNUT_PATH . 'archive-' . $taxonomy . '.php' ) ) {
				return WALNUT_PATH . 'archive-' . $taxonomy . '.php';
			}
			
			return $template;
		}
		
	}