<?php
	/** Альбомы */
	$obj = get_queried_object();
	$cols = get_sub_field( 'block-cols', $obj );
	$all = get_sub_field( 'display-all', $obj );
	if( $all ) {
		$terms = get_terms( array( 'taxonomy' => 'wt_gallery', 'hide_empty' => false, 'hierarchical' => false ) );
	} else {
		$terms = get_terms( array(
			'taxonomy' => 'wt_gallery', 'include' => get_sub_field( 'albums', $obj ), 'hide_empty' => false,
			'hierarchical' => false,
		) );
	}
	if( $terms ) {
		?>
		<ul class="wt-sections-row <?php wm_block_alignment(); ?>">
			<?php foreach( $terms as $term ) { ?>
				<li class="wt-sections-col col-sm-6 col-md-<?php wm_calc_cols( $cols ); ?>">
					<div class="wt-sections-item">
						<a href="<?php the_wt_term_link( $term->term_id ); ?>">
							<div class="wt-sections-icon">
								<?php
									$image = get_field( 'term-image', $term );
									if( $image ) {
										echo wp_get_attachment_image( $image, 'adaptive' );
									}
								?>
							</div>
							<div class="wt-sections-name"><?php echo get_field( 'term-shortname', $term )
									? get_field( 'term-shortname', $term ) : $term->name; ?></div>
						</a>
					</div>
				</li>
			<?php } ?>
		</ul>
		<?php
	}