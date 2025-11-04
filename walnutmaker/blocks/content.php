<?php
	/** Произвольный контент */
	$obj = get_queried_object();
?>
<section class="<?php wm_block_classes( 'wt-custom-content' ); ?>" <?php wm_block_styles(); ?>>
	<?php wm_container_open(); ?>
	
	<?php if( get_sub_field( 'title', $obj ) ) { ?>
		<div class="wt-custom-content-head">
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-custom-content-title"><?php the_sub_field( 'title', $obj ); ?></h2>
			<?php } ?>
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-custom-content-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
		</div>
	<?php } ?>
	
	<?php if( get_sub_field( 'content', $obj ) ) { ?>
		<div class="wt-custom-content-wrap wt-styles"> 
			<!-- itemprop="articleBody"> -->
			<?php the_sub_field( 'content', $obj ); ?>
		</div>
	<?php } ?>
	
	<?php get_template_part( 'blocks/parts/link' ); ?>
	
	<?php wm_container_close(); ?>
</section>