<?php
	/** Форма призыва к действию в сайдбаре */
	$obj = get_queried_object();
	$form = get_sub_field( 'form', $obj );
	if( $form && function_exists( 'wpcf7_contact_form_tag_func' ) ) {
		?>
		<aside class="wt-sidebar-block <?php wm_block_classes( 'wt-sidebar-form' ); ?>">

			<?php if( get_sub_field( 'title', $obj ) ) { ?>
				<h2 class="wt-sidebar-title"><?= do_shortcode(get_sub_field( 'title', $obj )); ?></h2>
			<?php } ?>

			<?php if( get_sub_field( 'desc', $obj ) ) { ?>
				<div class="wt-sidebar-description"><?php the_sub_field( 'desc', $obj ); ?></div>
			<?php } ?>

			<div class="wt-sidebar-form-fields">
				<?php echo wpcf7_contact_form_tag_func( array( 'id' => $form ), null, 'contact-form-7' ); ?>
			</div>

			<?php get_template_part( 'blocks/parts/link' ); ?>

		</aside>
		<?php
	}
