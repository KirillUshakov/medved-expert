<?php
	$obj = get_queried_object();
	$image = get_sub_field( 'image', $obj );
?>
<div class="wt-slider-banners-item wt-slider-banners-left">
	<?php wm_container_open(); ?>
	
	<?php if( $image ) { ?>
		<div class="wt-slider-banners-image">
			<?php echo wp_get_attachment_image( $image, 'full' ); ?>
		</div>
	<?php } ?>
	
	<div class="wt-slider-banners-content">
		
		<?php if( get_sub_field( 'title', $obj ) ) { ?>
			<h2 class="wt-slider-banners-content-title"><?php the_sub_field( 'title', $obj ); ?></h2>
		<?php } ?>
		
		<?php if( get_sub_field( 'desc', $obj ) ) { ?>
			<div class="wt-slider-banners-content-description wt-styles"><?php the_sub_field( 'desc', $obj ); ?></div>
		<?php } ?>
		
		<?php get_template_part( 'blocks/parts/action' ); ?>
	
	</div>
	
	<?php wm_container_close(); ?>
</div>