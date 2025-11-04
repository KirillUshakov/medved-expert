<div class="fileinput">
	<button type="submit" class="button button-primary upload_footer_logo"><?php _e( 'Upload' ); ?></button>
	<div class="uploaded-mediafiles">
		<?php if( isset( $data ) && $data ) { ?>
			<div class="mediafile attachment dashicons-container">
				<input type="hidden" name="footer_logo" value="<?php echo $data; ?>" />
				<div class="attachment-preview landscape">
					<div class="thumbnail">
						<div class="centered">
							<?php echo wp_get_attachment_image( $data, 'thumbnail' ); ?>
						</div>
						<div class="filename">
							<div><?php echo get_the_title( $data ); ?></div>
						</div>
					</div>
				</div>
				<span class="dashicons dashicons-no"></span>
			</div>
		<?php } ?>
	</div>
</div>