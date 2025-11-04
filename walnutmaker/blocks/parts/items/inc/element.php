<?php
	$obj = get_queried_object();
	$cols = get_sub_field( 'block-cols', $obj );
?>
<li class="wt-items-col col-sm-6 col-md-<?php wm_calc_cols( $cols ); ?>">
	<a class="wt-items-item" href="<?php the_permalink(); ?>">
		<div class="wt-items-thumbnail">
      <?php
        // the_post_thumbnail( 'adaptive' );
      ?>
      <img src="" data-src="<?= the_post_thumbnail_url( 'adaptive' ); ?>" alt="" class="attachment-adaptive size-adaptive wp-post-image">
    </div>
		<div class="wt-items-name">
			<?php echo get_field( 'shortname' ) ? get_field( 'shortname' ) : get_the_title(); ?>
		</div>
	</a>
</li>
