<?php
	$obj = get_queried_object();
	$cols = get_sub_field( 'block-cols', $obj );
?>
<li class="wt-items-col col-sm-6 col-md-<?php wm_calc_cols( $cols ); ?>">
	<a class="wt-items-item" href="<?php the_permalink(); ?>">
		<div class="wt-items-name">
			<?php echo get_field( 'shortname' ) ? get_field( 'shortname' ) : get_the_title(); ?>
		</div>
		<div class="wt-items-content"><?php the_content(); ?></div>
	</a>
</li>