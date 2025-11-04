<?php
	$obj = wm_field_option();
	if( get_field( 'order-form', $obj ) ) {
		?>
		<div id="modal-order" class="modal modal-order" data-selectable="true" style="display: none;">
			<?php if( get_field( 'order-title', $obj ) ) { ?>
				<div class="modal-title"><?php the_field( 'order-title', $obj ); ?></div>
			<?php } ?>
			<?php if( get_field( 'order-desc', $obj ) ) { ?>
				<div class="modal-description"><?php the_field( 'order-desc', $obj ); ?></div>
			<?php } ?>
			<div class="modal-wrap">
				<?php echo wpcf7_contact_form_tag_func( array( 'id' => get_field( 'order-form', $obj ) ), null,
					'contact-form-7' ); ?>
			</div>
		</div>
		<?php
	}