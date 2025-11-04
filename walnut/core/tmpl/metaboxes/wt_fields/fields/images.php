<?php if( isset( $field ) && is_array( $field ) && !empty( $field ) ) { ?>
	<div class="wt-field wt-images clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label'] ?></label>
		<button type="submit" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		        class="button button-primary upload_images"
		        data-code="<?php echo $this->add_prefix( $field['code'] ); ?>">
			<?php _e( 'Upload' ); ?>
		</button>
		<div class="uploaded-mediafiles">
			<?php if( isset( $data ) && is_array( $data ) && !empty( $data ) ) { ?>
				<?php foreach( $data as $file ) { ?>
					<?php if( $file ) { ?>
						<?php $item = get_post( $file ); ?>
						<div class="mediafile attachment dashicons-container mediafile-images">
							<input type="hidden"
							       name="<?php echo $this->add_prefix( $field['code'] ); ?>[<?php echo $file; ?>][title]"
							       value="<?php echo $item->post_title; ?>" data-id="<?php echo $file; ?>"/>
							<div class="attachment-preview landscape">
								<div class="thumbnail">
									<div class="centered">
										<?php echo wp_get_attachment_image( $file, 'thumbnail' ); ?>
									</div>
									<div class="filename">
										<div><?php echo get_the_title( $file ); ?></div>
									</div>
								</div>
							</div>
							<span class="dashicons dashicons-no"></span>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>