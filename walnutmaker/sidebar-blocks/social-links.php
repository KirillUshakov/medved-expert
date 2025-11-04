<?php
	/** Мы в социальных сетях */
	$obj = get_queried_object();
	$socials = get_sub_field( 'socials', $obj );
	if( $socials ) {
		?>
		<aside class="wt-sidebar-block <?php wm_block_classes( 'wt-sidebar-socials' ); ?>">
			
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-sidebar-title"><?php the_sub_field( 'title', $obj ); ?></h2>
			<?php } ?>
			
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-sidebar-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
			
			<?php wt_social_links( array(
				'links' => $socials,
				'class' => 'wt-sidebar-socials-list',
				'text' => ''
			) ); ?>
		
		</aside>
		<?php
	}