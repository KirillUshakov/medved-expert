<?php
	
	/**
	 * @param $categories
	 *
	 * Get parent categories recursively
	 *
	 * @return array
	 */
	function wt_get_parent_categories( $categories ) {
		if( !is_array( $categories ) || empty( $categories ) ) {
			return array();
		}
		$category = array_pop( $categories );
		$categories[] = $category;
		if( $category->parent != 0 ) {
			$parent_category = get_category( $category->parent );
			$categories[] = $parent_category;
		} else {
			return $categories;
		}
		$categories = wt_get_parent_categories( $categories );
		
		return $categories;
	}
	
	function wt_get_parent_terms( $term, $taxonomy ) {
		$terms[] = $term;
		foreach( get_ancestors( $term->term_id, $taxonomy ) as $id ) {
			$terms[] = get_term_by( 'id', $id, $taxonomy );
		}
		
		return $terms;
	}

	/**
	 * @param null $theme_location
	 * @param null $menu
	 * @param null $depth
	 *
	 * Print nav menu by theme location or menu name or depth
	 */
	function wt_nav_menu( $theme_location = null, $menu = null, $depth = null ) {
		$args = array( 'container' => false );
		if( $theme_location ) {
			$args['theme_location'] = $theme_location;
		}
		if( $menu ) {
			$args['menu'] = $menu;
		}
		if( is_numeric( $depth ) ) {
			$args['depth'] = $depth;
		}
		wp_nav_menu( $args );
	}

	/**
	 * @param $name
	 *
	 * Get theme settings by name
	 *
	 * @return null|string
	 */
	function wt_options( $name ) {
		$options = get_option( 'wt_settings' );
		if( isset( $options[ $name ] ) && $options[ $name ] && is_string( $options[ $name ] ) ) {
			return stripslashes( $options[ $name ] );
		} elseif( isset( $options[ $name ] ) && is_array( $options[ $name ] ) ) {
			foreach( $options[ $name ] as &$item ) {
				$item = stripslashes( $item );
			}

			return $options[ $name ];
		}

		return null;
	}
	
	/**
	 * @param string $key
	 * @param bool $source
	 * @param string $size
	 *
	 * Get header of footer logo
	 *
	 * @return array|false
	 */
	function wt_logo( $key = 'header_logo', $source = false, $size = 'full' ) {
		$option = get_option( 'wt_settings' );
		if( isset( $option[ $key ] ) ) {
			if( !$source ) {
				echo wp_get_attachment_image( $option[ $key ], $size );
			} else {
				return wp_get_attachment_image_src( $option[ $key ], $size );
			}
		}
		
		return false;
	}
	
	/**
	 * Get favicon
	 *
	 * @return bool|mixed|void
	 */
	function wt_get_favicon() {
		$option = get_option( 'wt_settings' );
		if( isset( $option['favicon'] ) ) {
			return wp_get_attachment_image_src( $option['favicon'], 'full' );
		}
		
		return false;
	}

	/**
	 * @param $name
	 *
	 * Get catalog settings by name
	 *
	 * @return null|string
	 */
	function wt_catalog_options( $name ) {
		$options = get_option( 'wt_catalog_settings' );
		if( isset( $options[ $name ] ) && $options[ $name ] ) {
			return stripslashes( $options[ $name ] );
		}
		
		return null;
	}
	
	/**
	 * @param $name
	 *
	 * Get gallery settings by name
	 *
	 * @return null|string
	 */
	function wt_gallery_options( $name ) {
		$options = get_option( 'wt_gallery_settings' );
		if( isset( $options[ $name ] ) && $options[ $name ] ) {
			return stripslashes( $options[ $name ] );
		}
		
		return null;
	}
	
	/**
	 * @param $name
	 * @param bool|true $echo
	 *
	 * Get form search from search directory
	 *
	 * @return bool|mixed
	 */
	function wt_form_search( $name = 'main', $echo = true ) {
		do_action( 'pre_get_search_form' );
		$format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';
		$format = apply_filters( 'search_form_format', $format );
		$search_form_template = locate_template( "search/{$name}.php" );
		if( '' == $search_form_template ) {
			return false;
		}
		ob_start();
		require( $search_form_template );
		$form = ob_get_clean();
		$result = apply_filters( 'get_search_form', $form );
		if( $result === null ) {
			return false;
		}
		if( $echo ) {
			echo $result;
		} else {
			return $result;
		}
		
		return true;
	}
	
	/**
	 * @param $num
	 * @param $titles
	 *
	 * Get endings for words by count
	 * Usage: wt_num_end( 'число', array( 'ending by 1', 'ending by 2,3,4', 'ending by 5,6,7,8,9,0' ) )
	 *
	 * @return mixed
	 */
	function wt_num_end( $num, $titles ) {
		$cases = array( 2, 0, 1, 1, 1, 2 );
		
		return $titles[ ( $num % 100 > 4 && $num % 100 < 20 ) ? 2 : $cases[ min( $num % 10, 5 ) ] ];
	}
	
	/**
	 * @param $category_id
	 *
	 * Get category link like wp permalink
	 *
	 */
	function the_wt_categorylink( $category_id ) {
		echo get_category_link( $category_id );
	}
	
	/**
	 * @param $term
	 * @param string $taxonomy
	 *
	 * Get term link like wp permalink
	 *
	 */
	function the_wt_term_link( $term, $taxonomy = '' ) {
		echo get_term_link( $term, $taxonomy );
	}

	/**
	 * @param $content
	 * @param $count
	 * @param string $type = 'word' or 'character'
	 * @param string $end
	 *
	 * @return string
	 */
	function wt_excerpt( $content, $count, $type = 'word', $end = '...' ) {
		if( $content && is_numeric( $count ) && $count > 0 && in_array( $type, array( 'character', 'word' ) ) ) {
			$excerpt = trim( strip_tags( $content ) );
			$excerpt = str_replace( "\r\n", ' ', $excerpt );
			
			switch( $type ) {
				case 'word':
					$words = explode( ' ', $excerpt, $count + 1 );
					array_pop( $words );
					$excerpt = implode( ' ', $words );
					break;
				case 'character':
					$words = explode( ' ', $excerpt );
					$new_words = array();
					foreach( $words as $word ) {
						$length = mb_strlen( $word );
						if( $count >= $length + 1 ) {
							$new_words[] = $word;
							$count -= $length + 1;
						} else {
							break;
						}
					}
					$excerpt = implode( ' ', $new_words );
					break;
			}
			
			return $excerpt . $end;
		}
		
		return '';
	}
