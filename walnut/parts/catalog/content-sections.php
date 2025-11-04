<?php
	$taxonomy_slug = get_query_var( 'taxonomy' );
	$term_slug = get_query_var( 'term' );
	$args = array( 'taxonomy' => $taxonomy_slug, 'hide_empty' => false );
	if( $term_slug ) {
		$term = get_term_by( 'slug', $term_slug, $taxonomy_slug );
		$args['parent'] = $term->term_id;
	} else {
		$args['parent'] = 0;
	}
	$terms = get_terms( $args );
?>
<?php if( is_array( $terms ) && !empty( $terms ) ) { ?>
	<div class="catalog__list clearfix">
		<?php foreach( $terms as $item ) { ?>
			<div class="catalog__wrap">
				<div class="catalog__item">
					<div class="catalog__about">
						<div class="catalog__name"><?php echo $item->name; ?></div>
						<p><?php echo wt_excerpt( $item->description, 7 ); ?></p>
						<a href="<?php echo get_term_link( $item->term_id ); ?>">
							<?php _ex( 'Read more', 'Text for button', 'walnut' ); ?>
						</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>