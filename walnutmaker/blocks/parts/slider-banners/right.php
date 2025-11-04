<div class="wt-slider-banners-item wt-slider-banners-right">
	<?php wm_container_open(); ?>

	<div class="wt-slider-banners-content">

		<?php if( get_sub_field( 'title', $obj ) ) { ?>
			<h2 class="wt-slider-banners-content-title"><?= do_shortcode(get_sub_field( 'title', $obj )); ?></h2>
		<?php } ?>

		<?php if( get_sub_field( 'desc', $obj ) ) { ?>
			<div class="wt-slider-banners-content-description wt-styles"><?php the_sub_field( 'desc', $obj ); ?></div>
		<?php } ?>

		<?php get_template_part( 'blocks/parts/action' ); ?>

	</div>

	<?php if( $image ) { ?>
		<div class="wt-slider-banners-image">
			<?php echo wp_get_attachment_image( $image, 'adaptive' ); ?>
		</div>
	<?php } ?>

	<?php wm_container_close(); ?>
</div>
