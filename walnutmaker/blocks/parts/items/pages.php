<?php
	/** Страницы */
	$obj = get_queried_object();
	$cols = get_sub_field( 'block-cols', $obj );
	$items = get_sub_field( 'pages', $obj );
	if( $items ) {
		echo '<ul class="wt-items-row content-' . wm_block_alignment( null, false ) . '">';
		global $post;
		foreach( $items as $post ) {
			setup_postdata( $post );
			get_template_part( 'blocks/parts/items/inc/page' );
		}
		echo '</ul>';
	}
	wp_reset_postdata();