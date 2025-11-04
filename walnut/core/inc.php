<?php
	//TODO: remove this backward compatibility function when version 1.0 is releasing
	$options = get_option( 'wt_settings' );
	if( ! $options ) {
		$options = get_option( 'wt_theme_settings' );
		if( $options ) {
			update_option( 'wt_settings', $options );
		}
	}
	
	if( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		get_template_part( 'core/classes/wt_update' );
		$wt_update = new WT_Update();
	}
	
	//Initialize work with sessions
	get_template_part( 'core/classes/wt_session' );
	$session = WT_Session::instance();
	
	//Initialize custom fields class
	get_template_part( 'core/classes/wt_fields' );
	$fields = WT_Fields::instance();
	
	function wt_fields( $post_id = null, $echo = true ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$fields_obj = WT_Fields::instance();
		$fields = $fields_obj->get_fields( $post_id );
		if( ! $echo ) {
			return $fields;
		}
		foreach( $fields as $field ) {
			$fields_obj->echo_field( $field );
		}
		
		return $echo;
	}
	
	function wt_field( $field_code, $post_id = null, $echo = true ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$fields_obj = WT_Fields::instance();
		$field = $fields_obj->get_field( $field_code, $post_id );
		if( ! $field || ! is_array( $field ) || ! isset( $field['type'] ) || ! isset( $field['value'] ) ) {
			return null;
		}
		if( ! $echo ) {
			return $field;
		}
		$fields_obj->echo_field( $field );
		
		return $echo;
	}
	
	function wt_form_fields( $echo = true ) {
		return WT_Fields::instance()->form_fields( $echo );
	}
	
	function wt_form_field( $field_code, $echo = true ) {
		return WT_Fields::instance()->form_field( $field_code, $echo );
	}
	
	//Initialize post types and taxonomies
	get_template_part( 'core/classes/wt_portfolio' );
	$cases = new WT_Portfolio();
	
	get_template_part( 'core/classes/wt_catalog' );
	$catalog = WT_Catalog::instance();
	
	get_template_part( 'core/classes/wt_gallery' );
	$gallery = new WT_Gallery();
	
	get_template_part( 'core/classes/wt_testimonials' );
	$testimonials = WT_Testimonials::instance();
	
	function wt_testimonial_fields( $post_id = null, $echo = true ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$testimonials = WT_Testimonials::instance();
		$fields = $testimonials->get_fields( $post_id );
		if( ! $echo ) {
			return $fields;
		}
		foreach( $fields as $field ) {
			$testimonials->echo_field( $field );
		}
		
		return $echo;
	}
	
	function wt_testimonial_field( $field_code, $post_id = null, $echo = true ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		$testimonials = WT_Testimonials::instance();
		$field = $testimonials->get_field( $field_code, $post_id );
		if( ! $field || ! is_array( $field ) || ! isset( $field['type'] ) || ! isset( $field['value'] ) ) {
			return null;
		}
		if( ! $echo ) {
			return $field;
		}
		$testimonials->echo_field( $field );
		
		return $echo;
	}
	
	function wt_testimonials_form_fields( $echo = true ) {
		return WT_Testimonials::instance()->form_fields( $echo );
	}
	
	function wt_testimonials_form_open( $echo = true ) {
		return WT_Testimonials::instance()->form_open( $echo );
	}
	
	function wt_testimonials_form_close( $echo = true ) {
		return WT_Testimonials::instance()->form_close( $echo );
	}
	
	function wt_testimonials_form_submit( $echo = true, $value = '' ) {
		return WT_Testimonials::instance()->form_submit( $echo, $value );
	}
	
	function wt_testimonials_form_content( $echo = true, $placeholder = '' ) {
		return WT_Testimonials::instance()->form_field_content( $echo, $placeholder );
	}
	
	function wt_testimonials_form_field( $field_code, $echo = true ) {
		return WT_Testimonials::instance()->form_field( $field_code, $echo );
	}
	
	get_template_part( 'core/classes/wt_likes' );
	$likes = WT_Likes::instance();
	
	function wt_get_like( $post_id = null ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		
		return WT_Likes::instance()->get_like( $post_id );
	}
	
	function wt_like_link( $text_before = '', $text_after = '', $post_id = null ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		WT_Likes::instance()->link( $text_before, $text_after, $post_id );
	}
	
	function wt_get_like_count( $post_id = null ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		
		return WT_Likes::instance()->get_count( $post_id );
	}
	
	function wt_get_likes_count( $like_posts ) {
		if( is_array( $like_posts ) && ! empty( $like_posts ) ) {
			$likes = WT_Likes::instance();
			$count = 0;
			foreach( $like_posts as $item ) {
				$count += $likes->get_count( $item->ID );
			}
			
			return $count;
		}
		
		return null;
	}
	
	get_template_part( 'core/classes/wt_ratings' );
	$ratings = WT_Ratings::instance();
	
	function wt_rating_block( $disable = false, $post_id = null ) {
		if( ! $post_id ) {
			$post_id = get_the_ID();
		}
		WT_Ratings::instance()->rating_block( $disable, $post_id );
	}
	
	//Initialize theme
	get_template_part( 'core/classes/wt_setup' );
	$wt_setup = new WT_Setup();
	
	if( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		//Initialize Mobile Detect
		get_template_part( 'core/classes/wt_mobile_detect' );
		$detect = WT_Mobile_Detect::instance();
		
		function wt_is_desktop( $userAgent = null, $httpHeaders = null ) {
			return ! WT_Mobile_Detect::instance()->isMobile( $userAgent, $httpHeaders );
		}
		
		function wt_is_device( $userAgent = null, $httpHeaders = null ) {
			return WT_Mobile_Detect::instance()->isMobile( $userAgent, $httpHeaders );
		}
		
		function wt_is_phone( $userAgent = null, $httpHeaders = null ) {
			$detect = WT_Mobile_Detect::instance();
			
			return $detect->isMobile( $userAgent, $httpHeaders ) && ! $detect->isTablet( $userAgent, $httpHeaders );
		}
		
		function wt_is_not_phone( $userAgent = null, $httpHeaders = null ) {
			$detect = WT_Mobile_Detect::instance();
			
			return $detect->isTablet( $userAgent, $httpHeaders ) || ! $detect->isMobile( $userAgent, $httpHeaders );
		}
		
		function wt_is_tablet( $userAgent = null, $httpHeaders = null ) {
			return WT_Mobile_Detect::instance()->isTablet( $userAgent, $httpHeaders );
		}
		
		function wt_is_not_tablet( $userAgent = null, $httpHeaders = null ) {
			return ! WT_Mobile_Detect::instance()->isTablet( $userAgent, $httpHeaders );
		}
		
		//Register functions
		get_template_part( 'core/functions' );
		
		//Register templates
		get_template_part( 'core/classes/wt_templates' );
		$templates = new WT_Templates();
		
		//Register breadcrumbs
		get_template_part( 'core/classes/wt_breadcrumbs' );
		$breadcrumbs = WT_Breadcrumbs::instance();
		
		function wt_breadcrumbs( $args = array(), $echo = true ) {
			return WT_Breadcrumbs::instance()->links( $args, $echo );
		}
		
		//Register components
		get_template_part( 'core/classes/wt_components' );
		$components = WT_Components::instance();
		
		function wt_social_links( $args = array() ) {
			WT_Components::instance()->social_links( $args );
		}
		
		function wt_social_link( $name ) {
			WT_Components::instance()->social_link( $name );
		}
		
		function get_social_links( $links = array() ) {
			return WT_Components::instance()->get_social_links( $links );
		}
		
		function get_social_link( $name ) {
			return WT_Components::instance()->get_social_link( $name );
		}
		
		function wt_share_links( $link = null, $text = '', $title = '', $link_text = false, $links = array() ) {
			WT_Components::instance()->share_links( $link, $text, $title, $link_text, $links );
		}
		
		function wt_share_link( $name, $link = null, $title = '', $link_text = false ) {
			WT_Components::instance()->share_link( $name, $link, $title, $link_text );
		}
		
		function wt_modal_frame_link( $before = '?', $echo = true ) {
			return WT_Components::instance()->modal_frame_link( $before, $echo );
		}
		
		function wt_modal_frame_class( $echo = true ) {
			return WT_Components::instance()->modal_frame_class( $echo );
		}
	}