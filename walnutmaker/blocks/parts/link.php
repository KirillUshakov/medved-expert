<?php
	/** Ссылка */
	$obj = get_queried_object();
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
	if( $link && isset( $link['url'] ) && $link['url'] ) {
		?>
		<div class="wt-action">
			<div class="wt-action-more">
				<?php $id = rand(); ?>
				
				<a href="<?php echo $link['url']; ?>"
				   class="btn btn-default me_phone"<?php echo isset( $link['target'] ) && $link['target'] ?
					' target="' . $link['target'] . '"' : ''; ?>>
					<?php echo isset( $link['title'] ) ? $link['title'] : ''; ?>
				</a>
			</div>
			<?php if( get_sub_field( 'link-hint' ) ) { ?>
				<p class="wt-action-hint"><?php the_sub_field( 'link-hint' ); ?></p>
			<?php } ?>
		</div>
		<?php
	}