<?php if( isset( $field ) && is_array( $field ) && !empty( $field ) ) { ?>
	<div class="ti-field ti-files clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label'] ?></label>
		<button type="submit" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		        class="button button-primary upload_files"
		        data-code="<?php echo $this->add_prefix( $field['code'] ); ?>">
			<?php _e( 'Upload' ); ?>
		</button>
		<div class="uploaded-mediafiles">
			<?php if( isset( $data ) && is_array( $data ) && !empty( $data ) ) { ?>
				<?php foreach( $data as $file ) { ?>
					<?php if( $file ) { ?>
						<div class="mediafile attachment dashicons-container mediafile-files">
							<?php $item = get_post( $file ); ?>
							<input type="hidden"
							       name="<?php echo $this->add_prefix( $field['code'] ); ?>[<?php echo $file; ?>][title]"
							       value="<?php echo $item->post_title; ?>"/>
							<a href="<?php echo wp_get_attachment_image_url( $file ); ?>" target="_blank">
								<?php echo $item->post_title; ?>
							</a>
							<span class="dashicons dashicons-no"></span>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>