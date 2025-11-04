<?php
	/** Записи */
	$obj = get_queried_object();
	$all = get_sub_field( 'display-all', $obj );
	if( $all ) {
		$terms = get_sub_field( 'categories', $obj );
		$items = new WP_Query( array(
			'posts_per_page' => get_option( 'posts_per_page' ),
			'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1, 'cat' => $terms,
		) );
	} else {
		$items = get_sub_field( 'posts', $obj );
	}
	if( $all ) {
		if( $items->have_posts() ) {
			//Pagination fix
			global $wp_query;
			$temp_query = $wp_query;
			$wp_query = null;
			$wp_query = $items;
			
			echo '<ul class="wt-items-row content-' . wm_block_alignment( null, false ) . '">';
			while( $items->have_posts() ) {
				$items->the_post();
				get_template_part( 'blocks/parts/items/inc/post' );
			}
			echo '</ul>';
			
			echo '<div class="wt-pagination">';
			the_posts_pagination( array( 'prev_text' => '&laquo;', 'next_text' => '&raquo;' ) );
			echo '</div>';
			
			//Pagination fix
			$wp_query = $temp_query;
		}
	} else {
		if( $items ) {
			echo '<ul class="wt-items-row content-' . wm_block_alignment( null, false ) . '">';
			global $post;
			foreach( $items as $post ) {
				setup_postdata( $post );
				get_template_part( 'blocks/parts/items/inc/post' );
			}
			echo '</ul>';
		}
	}
	wp_reset_postdata();