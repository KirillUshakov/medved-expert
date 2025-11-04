<?php
	$obj = wm_field_option();
	if( get_field( 'callback-form', $obj ) ) {
		?>
		<div id="wt-modal-callback" class="wt-modal wt-modal-callback" data-selectable="true" style="display: none;">
			<?php if( get_field( 'callback-title', $obj ) ) { ?>
				<div class="wt-modal-title"><?php the_field( 'callback-title', $obj ); ?></div>
			<?php } ?>
			<?php if( get_field( 'callback-desc', $obj ) ) { ?>
				<div class="wt-modal-description"><?php the_field( 'callback-desc', $obj ); ?></div>
			<?php } ?>
			<div class="wt-modal-form">
				<?php echo wpcf7_contact_form_tag_func( array( 'id' => get_field( 'callback-form', $obj ) ), null,
					'contact-form-7' ); ?>
				<div class="wt-privacy">
					Нажимая на кнопку «Оставить заявку», <a href="/politika-konfidentsialnosti/" target="_blank">я даю
						согласие на обработку персональных данных</a>
				</div>
			</div>
		</div>
		<?php
	}
