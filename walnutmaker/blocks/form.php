<?php
	/** Форма призыва к действию */
	$obj = get_queried_object();
	$type = get_sub_field( 'type', $obj );
	$form = get_sub_field( 'form', $obj );
	if( $type && $form && function_exists( 'wpcf7_contact_form_tag_func' ) ) {
		?>
		<section
				class="<?php wm_block_classes( 'wt-form' ); ?> wt-form-<?php echo $type; ?>" <?php wm_block_styles(); ?>>
			<?php wm_container_open(); ?>
			
			<div class="wt-form-wrap">
				
				<div class="wt-form-content">
					<?php if( get_sub_field( 'title', $obj ) ) { ?>
						<div class="wt-form-title"><?php the_sub_field( 'title', $obj ); ?></div>
					<?php } ?>
					
					<?php if( get_sub_field( 'desc', $obj ) ) { ?>
						<div class="wt-form-description"><?php the_sub_field( 'desc', $obj ); ?></div>
					<?php } ?>
				</div>
				
				<div class="wt-form-fields">
					<?php echo wpcf7_contact_form_tag_func( array( 'id' => $form ), null, 'contact-form-7' ); ?>
					<div class="wt-privacy">
						Нажимая на кнопку «Оставить заявку», <a href="/politika-konfidentsialnosti/" target="_blank">я даю
							согласие на обработку персональных данных</a>
					</div>
				</div>
			
			</div>
			
			<?php get_template_part( 'blocks/parts/link' ); ?>
			
			<?php wm_container_close(); ?>
		</section>
		<?php
	}