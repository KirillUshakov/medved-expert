<?php
	/** Интерактивная карта */
	$obj = get_queried_object();
	$code = wt_options( 'code_map' );
	if( $code ) {
		?>
		<section class="<?php wm_block_classes( 'wt-map' ); ?>">
			<?php wm_container_open(); ?>

			<div class="wt-map-wrap"><?php echo $code; ?></div>

			<?php if( get_sub_field( 'title', $obj ) || get_sub_field( 'desc', $obj ) ||
				get_sub_field( 'contacts-enable', $obj ) ) { ?>
				<div class="wt-map-contacts">

					<?php if( get_sub_field( 'title', $obj ) ) { ?>
						<h3 class="wt-map-title"><?= do_shortcode(get_sub_field( 'title', $obj )); ?></h3>
					<?php } ?>

					<?php if( get_sub_field( 'desc', $obj ) ) { ?>
						<div class="wt-map-description"><?php the_sub_field( 'desc', $obj ); ?></div>
					<?php } ?>

					<?php if( get_sub_field( 'contacts-enable', $obj ) ) { ?>
						<div class="wt-map-fields">

							<?php
								$field = wt_options( 'phone' );
								if( $field && isset( $field[ 'href' ] ) && isset( $field[ 'target' ] ) &&
									isset( $field[ 'title' ] ) ) {
									?>
									<div class="wt-map-field">
										<div class="wt-map-subtitle">Телефон:</div>
										<div class="wt-map-phone">
											<a href="<?php echo $field[ 'href' ]; ?>" <?php echo $field[ 'target' ]
												? 'target="_blank"' : ''; ?> class="me_phone">
												<?php echo $field[ 'title' ]; ?>
											</a>
										</div>
									</div>
									<?php
								}
							?>

							<?php
								$field = wt_options( 'email' );
								if( $field && isset( $field[ 'href' ] ) && isset( $field[ 'target' ] ) &&
									isset( $field[ 'title' ] ) ) {
									?>
									<div class="wt-map-field">
										<div class="wt-map-subtitle">Email-адрес:</div>
										<div class="wt-map-email">
											<a href="<?php echo $field[ 'href' ]; ?>" <?php echo $field[ 'target' ]
												? 'target="_blank"' : ''; ?>>
												<?php echo $field[ 'title' ]; ?>
											</a>
										</div>
									</div>
									<?php
								}
							?>

							<?php
								$field = wt_options( 'address' );
								if( $field ) {
									?>
									<div class="wt-map-field">
										<div class="wt-map-subtitle">Адрес:</div>
										<div class="wt-map-address"><?php echo $field; ?></div>
									</div>
									<?php
								}
							?>

							<?php
								$field = wt_options( 'worktime' );
								if( $field ) {
									?>
									<div class="wt-map-field">
										<div class="wt-map-subtitle">Режим работы:</div>
										<div class="wt-map-worktime"><?php echo $field; ?></div>
									</div>
									<?php
								}
							?>

							<?php
								$field = wt_options( 'distance' );
								if( $field ) {
									?>
									<div class="wt-map-field">
										<div class="wt-map-subtitle">Расположение:</div>
										<div class="wt-map-distance"><?php echo $field; ?></div>
									</div>
									<?php
								}
							?>

						</div>
					<?php } ?>

				</div>
			<?php } ?>

			<?php wm_container_close(); ?>
		</section>
		<?php
	}
