<?php
	function Declension($name) {
		$city = array('Москва', 'Коломна', 'Балашиха', 'Химки', 'Королёв', 'Красногорск', 'Люберцы', 'Мытищи', 'Одинцово',
  					  'Реутов', 'Видное', 'Зеленоград', 'Апрелевка', 'Долгопрудный', 'Домодедово', 'Жуковский', 'Ивантеевка',
					  'Кубинка', 'Лобня', 'Московский', 'Наро-Фоминск', 'Нахабино', 'Подольск', 'Пушкино', 'Раменское', 'Сергиев Посад',
					  'Солнечногорск', 'Троицк', 'Фрязино', 'Щёлково', 'Волоколамск', 'Голицыно', 'Дедовск', 'Звенигород', 'Истра', 'Лосино-Петровский',
					  'Митино', 'Старая Купавна', 'Щербинка', 'Бронницы', 'Воскресенск', 'Дмитров', 'Дубна', 'Кашира',
					  'Клин', 'Коломна', 'Красноармейск', 'Лыткарино', 'Можайск', 'Монино', 'Ногинск', 'Павловский Посад', 'Руза', 'Солнцево',
					  'Чехов', 'Электрогорск', 'Электросталь', 'Бутово', 'Котельники', 'Октябрьский', 'Сходня', 'Хотьково');
		$city_new = array('в Москве и МО', ' в Коломне', ' в Балашихе', ' в Химках', ' в Королёве', ' в Красногорске', ' в Люберцах', ' в Мытищах', ' в Одинцово',
  					  ' в Реутове', ' в Видном', ' в Зеленограде', ' в Апрелевке', ' в Долгопрудном', ' в Домодедово', ' в Жуковском', ' в Ивантеевке',
					  ' в Кубинке', ' в Лобне', ' в Московском', ' в Наро-Фоминске', ' в Нахабино', ' в Подольске', ' в Пушкино', ' в Раменском', ' в Сергиев Посаде',
					  ' в Солнечногорске', ' в Троицке', ' в Фрязино', ' в Щёлково', ' в Волоколамске', ' в Голицыно', ' в Дедовске', ' в Звенигороде', ' в Истре',
					  ' в Лосино-Петровском', ' в Митино', ' в Старой Купавне', ' в Щербинке', ' в Бронницах', ' в Воскресенске', ' в Дмитрове',
                      ' в Дубне', ' в Кашире', ' в Клине', ' в Коломне', ' в Красноармейске', ' в Лыткарино', ' в Можайске', ' в Монино', ' в Ногинске',
                      ' в Павловском Посаде', ' в Рузе', ' в Солнцево', ' в Чехове', ' в Электрогорске', ' в Электростале', ' в Бутово',
                      ' в Котельниках', ' в Октябрьском', ' в Сходне', ' в Хотьково');
		$find_position = array_search($name, $city);

		return $city_new[$find_position];
	}

	function get_cities() {
		$cities = array();

		foreach( get_sites() as $site ) {
			switch_to_blog( $site->blog_id );
			global $wp;

			$city_fields = [
				'name' => get_bloginfo( 'name' ),
				'url'  => home_url( $wp->request ) . '/',
				'url2' =>home_url( ) . '/',
				'id' => $site->blog_id,
			];

			$cities[ get_bloginfo( 'name' ) ] = $city_fields;
			restore_current_blog();
		}

		$moscow = array_shift( $cities );
		ksort( $cities );
		array_unshift( $cities, $moscow );

		return $cities;
	}

	get_template_part( 'inc/global-functions' );
	get_template_part( 'inc/actions' );
	get_template_part( 'inc/filters' );
	get_template_part( 'inc/shortcodes' );
	get_template_part( 'inc/wm_blocks' );

	/**
	 * Generate blocks for header location
	 *
	 * @return bool
	 */
	function wm_header_blocks() {
		return WM_Blocks::instance()->header_blocks();
	}

	/**
	 * Generate blocks for footer location
	 *
	 * @return bool
	 */
	function wm_footer_blocks() {
		return WM_Blocks::instance()->footer_blocks();
	}

	/**
	 * Generate blocks for content location
	 *
	 * @return bool
	 */
	function wm_content_blocks() {
		return WM_Blocks::instance()->content_blocks();
	}

	/**
	 * Generate blocks for sidebar location
	 *
	 * @return bool
	 */
	function wm_sidebar_blocks() {
		return WM_Blocks::instance()->sidebar_blocks();
	}

	/**
	 * Return have blocks in location
	 *
	 * @param string $location
	 *
	 * @return bool
	 */
	function wm_have_blocks( $location = 'content' ) {
		return WM_Blocks::instance()->have_blocks( $location );
	}

	/**
	 * Return have blocks in sidebar
	 *
	 * @return bool
	 */
	function wm_have_sidebar_blocks() {
		return WM_Blocks::instance()->have_sidebar_blocks();
	}

	/**
	 * @param bool $echo
	 *
	 * Echo container tag open for blocks if header of footer location set
	 *
	 * @return string
	 */
	function wm_container_open( $echo = true ) {
		return WM_Blocks::instance()->container_open( $echo );
	}

	/**
	 * @param bool $echo
	 *
	 * Echo container tag close for blocks if header of footer location set
	 *
	 * @return string
	 */
	function wm_container_close( $echo = true ) {
		return WM_Blocks::instance()->container_close( $echo );
	}

	/**
	 * @param int $cols
	 * @param bool $echo
	 *
	 * Calculate columns for tag class in blocks with columns
	 *
	 * @return mixed
	 */
	function wm_calc_cols( $cols, $echo = true ) {
		$cols = str_replace( '.', '-', 12 / $cols );
		if( $echo ) {
			echo $cols;
		}

		return $cols;
	}

	/**
	 * @param string $class
	 * @param null|object $obj
	 * @param bool $echo
	 *
	 * Generate classes for block
	 *
	 * @return string
	 */
	function wm_block_classes( $class, $obj = null, $echo = true ) {
		$obj = $obj ? $obj : get_queried_object();
		$classes = $class;
		$block_classes = get_sub_field( 'block-class', $obj );
		if( $block_classes ) {
			if( is_array( $block_classes ) ) {
				foreach( $block_classes as $block_class ) {
					$classes .= ' ' . $class . '-' . $block_class;
				}
			} else {
				$classes .= ' ' . $class . '-' . $block_classes;
			}
		}
		if( $echo ) {
			echo $classes;
		}

		return $classes;
	}

	/**
	 * @param null|object $obj
	 * @param bool $echo
	 *
	 * Return block styles
	 *
	 * @return string
	 */
	function wm_block_styles( $obj = null, $echo = true ) {
		$obj = $obj ? $obj : get_queried_object();
		$style = '';
		$text_color = get_sub_field( 'text-color', $obj );
		$background_color = get_sub_field( 'background-color', $obj );
		$background_image = get_sub_field( 'background-image', $obj );
		if( $text_color ) {
			$style .= 'color:' . $text_color . ';';
		}
		if( $background_color ) {
			$style .= 'background-color:' . $background_color . ';';
		}
		if( $background_image ) {
			$size = 'full';
			if( function_exists( 'wt_is_phone' ) && wt_is_phone() ) {
				$size = 'adaptive-mobile';
			} elseif( function_exists( 'wt_is_tablet' ) && wt_is_tablet() ) {
				$size = 'adaptive-tablet';
			}
			$style .= 'background-image:url(' . wp_get_attachment_image_url( $background_image, $size ) . ');';
		}
		if( $style ) {
			$style = 'style="' . $style . '"';
		}
		if( $echo ) {
			echo $style;
		}

		return $style;
	}

	/**
	 * @param null|object $obj
	 * @param bool $echo
	 *
	 * Return alignment for block elements
	 *
	 * @return bool
	 */
	function wm_block_alignment( $obj = null, $echo = true ) {
		$obj = $obj ? $obj : get_queried_object();
		$alignment = get_sub_field( 'block-alignment', $obj );
		if( $echo ) {
			echo 'content-' . $alignment;
		}

		return $alignment;
	}

	/**
	 * @param null|object $obj
	 * @param bool $echo
	 *
	 * Return alignment for block elements
	 *
	 * @return bool
	 */
	function wm_banner_alignment( $obj = null, $echo = true ) {
		$obj = $obj ? $obj : get_queried_object();
		$alignment = get_sub_field( 'content-alignment', $obj );
		if( $echo ) {
			echo 'wt-slider-banners-content-' . $alignment;
		}

		return $alignment;
	}

	/**
	 * @param null|object $obj
	 * @param bool $echo
	 *
	 * Return post name
	 *
	 * @return mixed|null|string
	 */
	function wm_post_name( $obj = null, $echo = true ) {
		$obj = $obj ? $obj : get_queried_object();
		$name = get_field( 'shortname', $obj ) ? get_field( 'shortname', $obj ) : get_the_title();
		if( $echo ) {
			echo $name;
		}

		return $name;
	}

	/**
	 * @param $name
	 * @param null|object $obj
	 *
	 * Return usability for posts of term
	 *
	 * @return bool
	 */
	function wm_usability( $name, $obj = null ) {
		$obj = $obj ? $obj : get_queried_object();
		$usability = get_field( 'posts-usability', $obj );

		return $usability ? in_array( $name, get_field( 'posts-usability', $obj ) ) : true;
	}

	/**
	 * @param null|object $obj
	 * @param bool $echo
	 *
	 * Return alignment for posts
	 *
	 * @return bool
	 */
	function wm_posts_alignment( $obj = null, $echo = true ) {
		$obj = $obj ? $obj : get_queried_object();
		$alignment = get_field( 'posts-alignment', $obj );
		if( $echo ) {
			echo 'content-' . $alignment;
		}

		return $alignment;
	}

	/**
	 * @param null|object $obj
	 * @param bool $echo
	 *
	 * Return alignment for pagination
	 *
	 * @return bool
	 */
	function wm_pagination_alignment( $obj = null, $echo = true ) {
		$obj = $obj ? $obj : get_queried_object();
		$alignment = get_field( 'posts-pagination-alignment', $obj );
		if( $echo ) {
			echo 'content-' . $alignment;
		}

		return $alignment;
	}

	/**
	 * Return post_id parameter of ACF options page for the_field and get_field functions
	 *
	 * @return bool|string
	 */
	function wm_field_option() {
		return function_exists( 'pll_current_language' ) ? pll_current_language( 'slug' ) : 'option';
	}
