<?php if( isset( $field ) && is_array( $field ) && !empty( $field ) ) { ?>
	<div class="ti-field ti-files clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label'] ?></label>
		<button type="submit" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		        class="button button-primary upload_file"
		        data-code="<?php echo $this->add_prefix( $field['code'] ); ?>">
			<?php _e( 'Upload' ); ?>
		</button>
		<div class="uploaded-mediafiles">
			<?php if( isset( $data ) && $data ) { ?>
				<div class="mediafile attachment dashicons-container mediafile-file">
					<input type="hidden" name="<?php echo $this->add_prefix( $field['code'] ); ?>"
					       value="<?php echo $data; ?>"/>
					<?php $item = get_post( $data ); ?>
					<a href="<?php echo wp_get_attachment_image_url( $data ); ?>" target="_blank">
						<?php echo $item->post_title; ?>
					</a>
					<span class="dashicons dashicons-no"></span>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>