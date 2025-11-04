<?php
	/** Элементы сайта */
	$obj = get_queried_object();
	$type = get_sub_field( 'type', $obj );
	if( $type ) {
		?>
		<section class="<?php wm_block_classes( 'wt-items' ); ?> wt-items-<?php echo $type; ?>" <?php wm_block_styles(); ?>>
			<?php wm_container_open(); ?>
			
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-items-title"><?php the_sub_field( 'title', $obj ); ?></h2>
			<?php } ?>
			
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-items-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
			
			<?php get_template_part( 'blocks/parts/items/' . $type ); ?>
			
			<?php get_template_part( 'blocks/parts/action' ); ?>
			
			<?php wm_container_close(); ?>
		</section>
		<?php
	}