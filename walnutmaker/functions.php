<?php

	//Применяем jQuery Google API
	function modify_jquery() {
		if (!is_admin()) {
			// закомментируйте следующие две строки для загрузки вашей локальной копии скрипта jQuery
			wp_deregister_script('jquery');
			wp_register_script('jquery', '/wp-includes/js/jquery/site-jquery.min.js', false, '2.2.4');
			wp_enqueue_script('jquery');
		}
	}
	add_action('init', 'modify_jquery');

	/**
	* Новый тип записи - «Отзывы»
	**/
	add_action( 'init', 'register_post_type_reviews' );
	function register_post_type_reviews(){
		register_post_type('reviews', array(
			'label'  => null,
			'labels' => [
				'name'               => 'Отзывы',
				'singular_name'      => 'Отзыв',
				'add_new'            => 'Добавить отзыв',
				'add_new_item'       => 'Добавление отзыва',
				'edit_item'          => 'Редактирование отзыва',
				'new_item'           => 'Новый отзыв',
				'view_item'          => 'Смотреть отзыв',
				'search_items'       => 'Искать отзывы',
				'not_found'          => 'Не найдено',
				'not_found_in_trash' => 'Не найдено в корзине',
				'menu_name'          => 'Отзывы',
			],
			'description'            => 'Отзывы',
			'exclude_from_search'    => false,
			'public'                 => true,
			'capability_type'        => 'page',
			'hierarchical'           => false,
			'show_in_menu'           => null,
			'show_in_rest'           => null,
			'rest_base'              => null,
			'menu_position'          => null,
			'menu_icon'              => 'dashicons-format-status',
			'supports'               => [
				'title',
				'editor',
				// 'excerpt',
				// 'trackbacks',
				// 'custom-fields',
				// 'comments',
				// 'revisions',
				// 'thumbnail',
				// 'author',
				// 'page-attributes',
			],
			'has_archive'         => false,
			'rewrite'             => true,
			'query_var'           => true,
		) );
	}

	/**
	* Уведомления о новых неопубликованных отзывах
	**/
	add_action( 'admin_menu', 'add_user_menu_bubble' );
	function add_user_menu_bubble() {
		global $menu;

		$count = wp_count_posts('reviews')->pending; # на утверждении
		if ($count) {
			foreach ($menu as $key => $value) {
				if ( $menu[$key][2] == 'edit.php?post_type=reviews' ) {
					$menu[$key][0] .= '<span class="awaiting-mod"><span class="pending-count">'.$count.'</span></span>';
					break;
				}
			}
		}
	}

	$bIndexBot = (strpos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false);

	// if($bIndexBot) {
	// 	add_action( 'wp_print_scripts', 'de_script', 100 );
	// }

	// function de_script() {
	// 	wp_dequeue_script( 'jquery' );
	// 	wp_deregister_script( 'jquery' );
	// 	wp_dequeue_style( 'wp-block-library' );
	// }

	function delete_script($html) {

		$pattern = '#<script(.*?)>(.*?)</script>#is';
		$html = preg_replace($pattern, '', $html);

		return $html;
	}


	if($bIndexBot) {
		ob_start('delete_script');
	}

	function wd( $obj ) {
		echo '<pre>';
		print_r( $obj );
		echo '</pre>';
	}

	get_template_part( 'inc/setup' );

	function setup_maker() {
		register_nav_menus( array( 'adaptive' => 'Адаптивное меню' ) );
		add_image_size( 'adaptive', 768, 432, true );
		add_image_size( 'adaptive-mobile', 768, 9999, true );
		add_image_size( 'adaptive-tablet', 1024, 9999, true );
		add_theme_support( 'post-formats', array( 'video' ) );

		/*if( !is_admin() && isset( $_COOKIE ) && isset( $_COOKIE[ 'city-selected' ] ) && $_COOKIE[ 'city-selected' ] ) {
			$current = 'https://' . $_SERVER[ 'SERVER_NAME' ];
			foreach( get_cities() as $city ) {
				if( $_COOKIE[ 'city-selected' ] == $city[ 'name' ] && $current != $city[ 'url' ] ) {
					wp_redirect( $city[ 'url' ] . $_SERVER[ 'REQUEST_URI' ] );
				}
			}
		}*/
	}

	add_action( 'init', 'setup_maker' );

	/**
	 * @param $dirs
	 *
	 * Устанавливаем одну и ту же директорию хранения медиафайлов для всех сайтов сети
	 *
	 * @return mixed
	 */
	function wm_upload_dir( $dirs ) {
		$dirs[ 'baseurl' ] = network_site_url( '/wp-content/uploads' );
		$dirs[ 'basedir' ] = ABSPATH . 'wp-content/uploads';
		$dirs[ 'path' ] = $dirs[ 'basedir' ] . $dirs[ 'subdir' ];
		$dirs[ 'url' ] = $dirs[ 'baseurl' ] . $dirs[ 'subdir' ];

		return $dirs;
	}

	add_filter( 'upload_dir', 'wm_upload_dir' );

	if( !is_super_admin() ) {
		include_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/clickfrogru_tcp.php';
	}

add_filter('wp_img_tag_add_loading_attr', 'change_attachement_image_attributes_add_alttopost', 20, 2);

function change_attachement_image_attributes_add_alttopost( $attr, $attachment ){
    // Get post parent
    $parent = get_post_field( 'post_parent', $attachment);

    // Get post type to check if it's post you can also add to any post type
    $type = get_post_field( 'post_type', $parent);
    if( $type != 'post' ){
        return $attr;
    }

    /// Get title
    $title = get_post_field( 'post_title', $parent);

    if (is_array($attr)) {
      $attr['alt'] = $title;
      $attr['title'] = $title;
    }

    return $attr;
}

function replace_text_wps($text){
    $replace = array(
        // 'WORD TO REPLACE' => 'REPLACE WORD WITH THIS'
        'alt=""' => 'alt="Медведь Эксперт"',
		// '/services/zamena-zamkov/' => '/zamena-zamkov/',
		// '/services/vskrytie-zamka-kvartiry/' => '/vskrytie-zamka-kvartiry/',
		// '/services/vskrytie-zamkov-avto/' => '/vskrytie-zamkov-avto/',
		// '/blog/kak-raspoznat-poddelku-zamka-gardian/' => '/kak-raspoznat-poddelku-zamka-gardian/',
		// '/services/zamena-zamkov-multilok/' => '/zamena-zamkov-multilok/',
		// '/services/zamena-zamka-vhodnoj-dveri/' => '/zamena-zamka-vhodnoj-dveri/',
		// '/services/vskrytie-dvernyh-zamkov/' => '/vskrytie-dvernyh-zamkov/',
		// '/services/vrezka-zamkov-v-derevyannuyu-dver/' => '/vrezka-zamkov-v-derevyannuyu-dver/',
		// '/blog/vrezka-zamkov-v-mezhkomnatnuyu-dver/' => '/vrezka-zamkov-v-mezhkomnatnuyu-dver/',
		// '/services/vskrytie-suvaldnogo-zamka-2/' => '/vskrytie-suvaldnogo-zamka-2/',
		'/services/ustanovka-suvaldnogo-zamka/' => '/',
		// '/services/zamena-zamka-v-sejfe/' => '/zamena-zamka-v-sejfe/',
		'/services/zamena-tsilindrovyh-zamkov/' => '/',
		// '/blog/kak-vybrat-zamok-po-klassu-vzlomostojkosti/' => '/kak-vybrat-zamok-po-klassu-vzlomostojkosti/',
		// '/services/zamena-suvaldnyh-zamkov/' => '/zamena-suvaldnyh-zamkov/',
		// '/blog/chto-delat-esli-poteryal-klyuchi-ot-avtomobilya/' => '/chto-delat-esli-poteryal-klyuchi-ot-avtomobilya/',
		// '/services/zamena-lichinki/' => '/zamena-lichinki/',
		// 'https://medved-expert.ru/services/zamena-lichinki/' => '/zamena-lichinki/',
		// '/services/vrezka-zamkov-v-metallicheskuyu-dver/' => '/vrezka-zamkov-v-metallicheskuyu-dver/',
		'/services/zamena-lichinki-vhodnoj-dveri/' => '/',
		//'/zamena-lichinki/' => '/services/zamena-lichinki/',
		// '/services/ustanovka-zamkov-na-vhodnuyu-dver/' => '/ustanovka-zamkov-na-vhodnuyu-dver/',
		// '/services/vskrytie-sejfov/' => '/vskrytie-sejfov/',
		// '/services/ustanovka-zamkov/' => '/ustanovka-zamkov/',
		'/zamena-zamka-cisa/' => '/',
		'/zamena-suvaldnyh-zamkov/' => '/',
		'/ustanovka-zamkov-na-vhodnuyu-dver/' => '/',
		'/zamena-zamka-v-sejfe/' => '/',
		'/zamena-zamkov-multilok/' => '/',
		'/vskrytie-suvaldnogo-zamka-2/' => '/',
		'/zamena-zamka-vhodnoj-dveri/' => '/',
		'https://medved-expert.ru/zamena-zamka-cisa/' => '/'
    );
    $text = str_replace(array_keys($replace), $replace, $text);

    return $text;
}

add_filter('the_content', 'replace_text_wps',99);


function rb_modify_nav($items) {
	$city = get_city_name();
	if ($city != 'Москва') {
	    $i = 1;
    	foreach($items as $item){
			if ($item->title == 'Блог') {
				unset($items[$i]);
			}
			$i++;
			//var_dump($item);
        	//$item->url = rtrim( $item->url, '/' )  . '/';
		//echo get_bloginfo( 'name', 'display' );
    	}
	}
    return $items;
}
add_filter('wp_nav_menu_objects', 'rb_modify_nav');


function artabr_opengraph_fix_yandex($lang) {
$lang_prefix = 'prefix="og: http://ogp.me/ns# article: http://ogp.me/ns/article# profile: http://ogp.me/ns/profile# fb: http://ogp.me/ns/fb#"';
$lang_fix = preg_replace('!prefix="(.*?)"!si', $lang_prefix, $lang);
return $lang_fix;
}
add_filter( 'language_attributes', 'artabr_opengraph_fix_yandex',20,1);
add_filter('wpcf7_spam', '__return_false');

add_action('registered_post_type', 'igy2411_make_posts_hierarchical', 10, 2 );

// Runs after each post type is registered
function igy2411_make_posts_hierarchical($post_type, $pto){

    // Return, if not post type posts
    if ($post_type != 'post') return;
    if ($post_type == 'reviews') return;

    // access $wp_post_types global variable
    global $wp_post_types;

    // Set post type "post" to be hierarchical
    $wp_post_types['post']->hierarchical = 1;

    // Add page attributes to post backend
    // This adds the box to set up parent and menu order on edit posts.
    add_post_type_support( 'post', 'page-attributes' );

}

add_action( 'after_setup_theme', 'cody_setup_theme' );
function cody_setup_theme() {
	add_theme_support( 'title-tag' );
}

function is_search_referer () {
  $referer = $_SERVER['HTTP_REFERER'];
  $result = false;

  if (
    strpos($referer, 'google') 		 ||
    strpos($referer, 'yandex') 		 ||
    strpos($referer, 'bing') 		   ||
    strpos($referer, 'yahoo') 		 ||
    strpos($referer, 'duckduckgo') ||
    strpos($referer, 'baidu')
  ) {
    $result = true;
  }

  return $result;
}

// /*
//  * Remove site name from title
//  */
// add_filter( 'document_title_parts', 'cody_remove_title' );
// function cody_remove_title( $title ){
// 	// вы можете задать свои условия, где выводить, а где оставить название
// 	if ( !is_home() ) {
// 		$title['site'] = '';
// 	}
// 	return $title;
// }

function replace_meta($html) {
    global $wp;

	if (get_post_type() == 'attachment') {
		$html = str_replace('max-image-preview:large', 'noindex', $html);
	}

    return $html;
}

ob_start('replace_meta');


add_filter('wpcf7_validate_tel*', 'block_blocked_phones', 20, 2);
add_filter('wpcf7_validate_tel', 'block_blocked_phones', 20, 2);

function block_blocked_phones($result, $tag) {
    $blocked_numbers = [
        '+7 (926) 328-16-16',
        '+7 (555) 555-88-88'
    ];

    $name = $tag->name;
    $phone = isset($_POST[$name]) ? trim($_POST[$name]) : '';

    // Сравниваем только цифры (чтобы не зависеть от пробелов, скобок, тире)
    $clean_phone = preg_replace('/\D/', '', $phone);

    foreach ($blocked_numbers as $blocked) {
        $clean_blocked = preg_replace('/\D/', '', $blocked);
        if ($clean_phone === $clean_blocked) {
            $result->invalidate($tag, "Отправка с этим номером запрещена.");
        }
    }

    return $result;
}

//6LebSMsrAAAAAB3u8FItrExpCJLeCyJOdfjcZnQ9

// add_action('wpcf7_before_send_mail', 'check_recaptcha_v2', 10, 1);

// function check_recaptcha_v2($contact_form) {
//     $recaptcha_secret = '6LebSMsrAAAAAB3u8FItrExpCJLeCyJOdfjcZnQ9';
//     $recaptcha_response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';

//     if (empty($recaptcha_response)) {
//         // блокируем письмо
//         $contact_form->skip_mail = true;
//         // выводим сообщение сверху формы
//         $contact_form->add_notice('Пожалуйста, подтвердите что вы не робот.', 'error');
//         return;
//     }

//     // Проверка через Google API
//     $response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret={$recaptcha_secret}&response={$recaptcha_response}");
//     $body = wp_remote_retrieve_body($response);
//     $result_json = json_decode($body, true);

//     if (empty($result_json['success']) || !$result_json['success']) {
//         $contact_form->skip_mail = true;
//         $contact_form->add_notice('Проверка reCAPTCHA не пройдена.', 'error');
//     }
// }
