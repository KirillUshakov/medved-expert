<div class="social-link">
	<button type="submit" class="button button-primary upload_social" data-social="linkedin"><?php _e( 'Upload' ); ?></button>
	<div class="uploaded-mediafiles">
		<?php if( isset( $data['icon'] ) && $data['icon'] ) { ?>
			<div class="mediafile attachment dashicons-container">
				<input type="hidden" name="linkedin[icon]" value="<?php echo $data['icon']; ?>"/>
				<div class="attachment-preview">
					<div class="thumbnail">
						<div class="centered">
							<?php echo wp_get_attachment_image( $data['icon'], 'thumbnail' ); ?>
						</div>
						<div class="filename">
							<div><?php echo get_the_title( $data['icon'] ); ?></div>
						</div>
					</div>
				</div>
				<span class="dashicons dashicons-no"></span>
			</div>
		<?php } ?>
	</div>
	<input type="text" name="linkedin[link]" value="<?php echo isset( $data['link'] ) ? $data['link'] : ''; ?>"/>
</div>