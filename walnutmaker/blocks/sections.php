<?php
	/** Разделы */
	$obj = get_queried_object();
	$type = get_sub_field( 'type', $obj );
	if( $type ) {
		?>
		<section class="<?php wm_block_classes( 'wt-sections' ); ?> wt-sections-<?php echo $type; ?>" <?php wm_block_styles(); ?>>
			<?php wm_container_open(); ?>
			
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-sections-title"><?php the_sub_field( 'title', $obj ); ?></h2>
			<?php } ?>
			
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-sections-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
			
			<?php get_template_part( 'blocks/parts/sections/' . $type ); ?>
			
			<?php get_template_part( 'blocks/parts/action' ); ?>
			
			<?php wm_container_close(); ?>
		</section>
		<?php
	}