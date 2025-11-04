<?php if( isset( $field ) && is_array( $field ) && !empty( $field ) ) { ?>
	<div class="ti-field ti-videos clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label'] ?></label>
		<button type="submit" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		        class="button button-primary upload_video"
		        data-code="<?php echo $this->add_prefix( $field['code'] ); ?>">
			<?php _e( 'Upload' ); ?>
		</button>
		<div class="uploaded-mediafiles">
			<?php if( isset( $data ) && $data ) { ?>
				<div class="mediafile attachment dashicons-container mediafile-video">
					<input type="hidden" name="<?php echo $this->add_prefix( $field['code'] ); ?>"
					       value="<?php echo $data; ?>"/>
					<?php $data = get_post( $data ); ?>
					<?php echo wp_video_shortcode( array( 'src' => wp_get_attachment_url( $data ) ) ); ?>
					<span class="dashicons dashicons-no"></span>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>