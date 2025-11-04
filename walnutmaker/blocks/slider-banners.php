<?php
	/** Слайдер изображений */
	$obj = get_queried_object();
?>
<section class="<?php wm_block_classes( 'wt-slider-banners' ); ?>" <?php wm_block_styles(); ?>>
	
	<?php if( get_sub_field( 'title', $obj ) ) { ?>
	<div class="wt-slider-banners-head">
		<div class="container">
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h3 class="wt-slider-banners-title"><?php the_sub_field( 'title', $obj ); ?></h3>
			<?php } ?>
			
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-slider-banners-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
		</div>
	</div>
	<?php } ?>
	
	<div class="wt-slider-banners-wrap owl-carousel" data-options="<?php echo htmlspecialchars( json_encode( get_sub_field( 'options', $obj ) ), ENT_QUOTES,
				'UTF-8' ); ?>" data-speed="<?php the_sub_field( 'speed', $obj ); ?>" data-interval="<?php the_sub_field( 'interval', $obj ); ?>" data-cols="<?php the_sub_field( 'block-cols', $obj ); ?>">
		<?php
			if( have_rows( 'slides', $obj ) ) {
				while( have_rows( 'slides', $obj ) ) {
					the_row();
					get_template_part( 'blocks/parts/slider-banners/' . get_sub_field( 'type', $obj ) );
				}
			}
		?>
	</div>

</section>