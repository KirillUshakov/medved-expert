<?php
	/** Поделиться в социальных сетях */
	$obj = get_queried_object();
	$socials = get_sub_field( 'socials', $obj );
	if( $socials ) {
		?>
		<div class="<?php wm_block_classes( 'wt-share-links' ); ?> <?php wm_block_alignment(); ?>">
			<?php wm_container_open(); ?>
			
			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<div class="wt-share-links-title"><?php the_sub_field( 'title', $obj ); ?></div>
			<?php } ?>
			
			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-share-links-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>
			
			<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
			<script src="//yastatic.net/share2/share.js"></script>
			<div class="ya-share2" data-services="<?php echo implode( ',', $socials ); ?>"<?php
				echo get_sub_field( 'counter', $obj ) ? ' data-counter=""' : ''; ?>></div>
			
			<?php wm_container_close(); ?>
		</div>
		<?php
	}