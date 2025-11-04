<?php
	/**
	 * @param $template
	 * @param $class
	 *
	 * Remove h2 from pagination
	 *
	 * @return string
	 */
	function wm_pagination_template( $template, $class ) {
		return '<nav class="navigation %1$s" role="navigation"><div class="nav-links">%3$s</div></nav>';
	}
	
	add_filter( 'navigation_markup_template', 'wm_pagination_template', 10, 2 );
	
	/**
	 * @param $title
	 *
	 * Remove taxonomy name from archive title
	 *
	 * @return string
	 */
	function wm_archive_title( $title ) {
		if( is_category() || is_tax() || is_tag() ) {
			$title = single_term_title( '', false );
		} elseif( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		}
		
		return $title;
	}
	
	add_filter( 'get_the_archive_title', 'wm_archive_title' );
	
	/**
	 * @param $choices
	 *
	 * Add ACF rule operator for match current and child
	 *
	 * @return mixed
	 */
	function wm_acf_location_rules_operators( $choices ) {
		$choices[ '=_' ] = 'текущая и дочерние';
		
		return $choices;
	}
	
	add_filter( 'acf/location/rule_operators', 'wm_acf_location_rules_operators' );
	
	/**
	 * @param $match
	 * @param $rule
	 * @param $options
	 *
	 * Add ACF rule match for current and child categories
	 *
	 * @return bool
	 */
	function wm_acf_location_rules_match_post_category( $match, $rule, $options ) {
		if( $rule[ 'operator' ] == '=_' ) {
			$value = explode( ':', $rule[ 'value' ] );
			if( $value && isset( $value[ 1 ] ) ) {
				$slug = $value[ 1 ];
				$category = get_category_by_slug( $slug );
				if( $category ) {
					$categories = get_categories( array( 'child_of' => $category->term_id, 'hide_empty' => false ) );
					if( $categories ) {
						$ids = array( $category->term_id );
						foreach( $categories as $category ) {
							$ids[] = $category->term_id;
						}
						$cur_cats = get_the_category();
						if( $cur_cats && isset( $cur_cats[ 0 ] ) && property_exists( $cur_cats[ 0 ], 'term_id' ) &&
							in_array( $cur_cats[ 0 ]->term_id, $ids ) ) {
							$match = true;
						}
					}
				}
			}
		}
		
		return $match;
	}
	
	add_filter( 'acf/location/rule_match/post_category', 'wm_acf_location_rules_match_post_category', 10, 3 );
	
	/**
	 * @param $choices
	 *
	 * Add ACF rules for edit terms
	 *
	 * @return mixed
	 */
	function wm_acf_location_rules_values( $choices ) {
		$choices[ 'category' ] = 'Категория';
		$choices[ 'wt_case_category' ] = 'Раздел портфолио';
		$choices[ 'wt_element_category' ] = 'Раздел каталога';
		$choices[ 'wt_gallery' ] = 'Альбом галереи';
		
		return $choices;
	}
	
	add_filter( 'acf/location/rule_values/post_type', 'wm_acf_location_rules_values' );
	
	/**
	 * @param $match
	 * @param $rule
	 * @param $options
	 *
	 * Add ACF matches for edit terms
	 *
	 * @return bool
	 */
	function wm_acf_location_rules_match( $match, $rule, $options ) {
		$screen = get_current_screen();
		if( $rule[ 'value' ] == 'category' ) {
			if( $rule[ 'operator' ] == "==" ) {
				$match = ( $screen->id == 'edit-category' );
			} elseif( $rule[ 'operator' ] == "!=" ) {
				$match = ( $screen->id != 'edit-category' );
			}
		} elseif( $rule[ 'value' ] == 'wt_case_category' ) {
			if( $rule[ 'operator' ] == "==" ) {
				$match = ( $screen->id == 'edit-wt_case_category' );
			} elseif( $rule[ 'operator' ] == "!=" ) {
				$match = ( $screen->id != 'edit-wt_case_category' );
			}
		} elseif( $rule[ 'value' ] == 'wt_element_category' ) {
			if( $rule[ 'operator' ] == "==" ) {
				$match = ( $screen->id == 'edit-wt_element_category' );
			} elseif( $rule[ 'operator' ] == "!=" ) {
				$match = ( $screen->id != 'edit-wt_element_category' );
			}
		} elseif( $rule[ 'value' ] == 'wt_gallery' ) {
			if( $rule[ 'operator' ] == "==" ) {
				$match = ( $screen->id == 'edit-wt_gallery' );
			} elseif( $rule[ 'operator' ] == "!=" ) {
				$match = ( $screen->id != 'edit-wt_gallery' );
			}
		}
		
		return $match;
	}
	
	add_filter( 'acf/location/rule_match/post_type', 'wm_acf_location_rules_match', 10, 3 );
	
	// Callback function to filter the MCE settings
	function wm_mce_before_init_insert_formats( $init_array ) {
		// Define the style_formats array
		$style_formats = array(
			// Each array child is a format with it's own settings
			array( 'title' => 'Синий текст', 'inline' => 'span', 'classes' => 'text-blue', 'wrapper' => false, ),
			array( 'title' => 'Жёлтый текст', 'inline' => 'span', 'classes' => 'text-yellow', 'wrapper' => false, ),
			array( 'title' => 'Красный текст', 'inline' => 'span', 'classes' => 'text-red', 'wrapper' => false, ),
		);
		// Insert the array, JSON ENCODED, into 'style_formats'
		$init_array[ 'style_formats' ] = json_encode( $style_formats );
		
		return $init_array;
		
	}
	
	// Attach callback to 'tiny_mce_before_init'
	add_filter( 'tiny_mce_before_init', 'wm_mce_before_init_insert_formats' );
	
	function wm_theme_add_editor_styles() {
		add_editor_style();
	}
	
	add_action( 'current_screen', 'wm_theme_add_editor_styles' );
	
	function wm_add_class_for_svg( $image ) {
		global $bodhi_svgs_options;
		if( isset( $bodhi_svgs_options ) && isset( $bodhi_svgs_options[ 'css_target' ] ) &&
			strpos( $image[ 'src' ], '.svg' ) !== false ) {
			$class = !empty( $bodhi_svgs_options[ 'css_target' ] ) ? $bodhi_svgs_options[ 'css_target' ] : 'style-svg';
			$image[ 'class' ] .= ' ' . $class;
		}
		
		return $image;
	}
	
	add_filter( 'wp_get_attachment_image_attributes', 'wm_add_class_for_svg', 10, 1 );
	
	function wm_tiny_mce_editor_options( $initArray ) {
		$initArray[ 'invalid_styles' ] = "{'tr':'width height','th':'width height','td':'width height'}";
		$initArray[ 'extended_valid_elements' ] = "table[class]";
		
		return $initArray;
	}
	
	add_filter( 'tiny_mce_before_init', 'wm_tiny_mce_editor_options' );