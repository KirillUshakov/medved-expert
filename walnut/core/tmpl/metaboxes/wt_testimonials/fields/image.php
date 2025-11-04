<?php if( isset( $field ) && is_array( $field ) && !empty( $field ) ) { ?>
	<div class="ti-field ti-images clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label'] ?></label>
		<button type="submit" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		        class="button button-primary upload_image"
		        data-code="<?php echo $this->add_prefix( $field['code'] ); ?>">
			<?php _e( 'Upload' ); ?>
		</button>
		<div class="uploaded-mediafiles">
			<?php if( isset( $data ) && $data ) { ?>
				<div class="mediafile attachment dashicons-container mediafile-image">
					<input type="hidden" name="<?php echo $this->add_prefix( $field['code'] ); ?>"
					       value="<?php echo $data; ?>"/>
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
<?php } ?>