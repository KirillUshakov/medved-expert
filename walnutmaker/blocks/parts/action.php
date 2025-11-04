<?php
	/** Призыв к действию */
	$obj = get_queried_object();
	$hint = get_sub_field( 'action-hint', $obj );
	if( have_rows( 'action', $obj ) ) {
		while( have_rows( 'action', $obj ) ) {
			the_row();
			$phone_settings = get_sub_field( 'phone-settings', $obj );
			if( $phone_settings ) {
				$phone = wt_options( 'phone' );
				if( $phone && $phone['href'] ) {
					$link['url'] = $phone['href'];
					$link['title'] = $phone['title'];
					$link['target'] = $phone['target'];
				}
			} else {
				$link = get_sub_field( 'link', $obj );
			}
			if( $link && isset( $link['url'] ) && $link['url'] ) { ?>
				<div class="wt-action">
					<div class="wt-action-more">
						<?php $id = rand(); ?>
						<a data-src="#wt-modal-<?php echo $id; ?>" href="<?php echo $link['url']; ?>"
						   class="btn btn-default me_phone<?php echo get_sub_field( 'action-enable', $obj ) ?
							   ' modal-open' : ''; ?>"
							<?php echo isset( $link['target'] ) && $link['target'] ?
								'target="' . $link['target'] . '"' : ''; ?>>
							<?php echo isset( $link['title'] ) ? $link['title'] : ''; ?>
						</a>
						<?php if( get_sub_field( 'action-enable', $obj ) && get_sub_field( 'action-form', $obj ) ) { ?>
							<div id="wt-modal-<?php echo $id; ?>" class="wt-modal" data-selectable="true"
								 style="display: none;">
								<?php if( get_sub_field( 'action-title', $obj ) ) { ?>
									<div class="wt-modal-title"><?php the_sub_field( 'action-title', $obj ); ?></div>
								<?php } ?>
								<?php if( get_sub_field( 'action-desc', $obj ) ) { ?>
									<div class="wt-modal-description"><?php the_sub_field( 'action-desc',
											$obj ); ?></div>
								<?php } ?>
								<div class="wt-modal-form">
									<?php echo wpcf7_contact_form_tag_func( array(
										'id' => get_sub_field( 'action-form', $obj ),
									), null, 'contact-form-7' ); ?>
									<div class="wt-privacy">
										Нажимая на кнопку «Оставить заявку», <a href="/politika-konfidentsialnosti/"
																				target="_blank">я даю
											согласие на обработку персональных данных</a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
					<?php if( $hint ) { ?>
						<p class="wt-action-hint"><?php echo $hint; ?></p>
					<?php } ?>
				</div>
				<?php
			}
		}
	}