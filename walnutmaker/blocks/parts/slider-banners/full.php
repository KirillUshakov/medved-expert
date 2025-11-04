<?php
	$obj = get_queried_object();
	$image = get_sub_field( 'image', $obj );
?>
<div class="wt-slider-banners-item wt-slider-banners-full" <?php
	$size = 'full';
	if( function_exists( 'wt_is_phone' ) && wt_is_phone() ) {
		$size = 'adaptive-mobile';
	} elseif( function_exists( 'wt_is_tablet' ) && wt_is_tablet() ) {
		$size = 'adaptive-tablet';
	}
	echo $image ? 'style="background-image: url(\'' . wp_get_attachment_image_url( $image, $size ) . '\');"' : ''; ?>>
	<?php wm_container_open(); ?>
	
	<div class="wt-slider-banners-content <?php wm_banner_alignment(); ?>">
		
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