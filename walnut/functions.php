<?php get_template_part( 'core/inc' );
	
	/**
	 * Add adaptive size for images
	 */
	add_image_size( 'adaptive', 500, 365, true );
	
	/**
	 * Customizer
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function wt_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-name-title a', 'render_callback' => 'wt_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-name-description', 'render_callback' => 'wt_customize_partial_blogdescription',
		) );
	}
	
	add_action( 'customize_register', 'wt_customize_register' );
	
	/**
	 * Print blog name for customizer preview
	 */
	function wt_customize_partial_blogname() {
		bloginfo( 'name' );
	}
	
	/**
	 * Print blog description for customizer preview
	 */
	function wt_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}
	
	function wt_widgets_init() {
		register_sidebar( array(
			'name' => _x( 'Modal Widget', 'Name of widget', 'walnut' ), 'id' => 'modal-widget',
			'description' => __( 'Widgets in this area will be shown on modal window.', 'walnut' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>',
			'before_title' => '<div class="modal-widget-title">', 'after_title' => '</div>',
		) );
	}
	
	add_action( 'widgets_init', 'wt_widgets_init' );