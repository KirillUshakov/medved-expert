<?php if( isset( $field ) && is_array( $field ) && !empty( $field ) ) { ?>
	<div class="wt-field wt-videos clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label'] ?></label>
		<button type="submit" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		        class="button button-primary upload_videos"
		        data-code="<?php echo $this->add_prefix( $field['code'] ); ?>">
			<?php _e( 'Upload' ); ?>
		</button>
		<div class="uploaded-mediafiles">
			<?php if( isset( $data ) && is_array( $data ) && !empty( $data ) ) { ?>
				<?php foreach( $data as $file ) { ?>
					<?php if( $file ) { ?>
						<?php $item = get_post( $file ); ?>
						<div class="mediafile attachment dashicons-container mediafile-videos">
							<input type="hidden"
							       name="<?php echo $this->add_prefix( $field['code'] ); ?>[<?php echo $file; ?>][title]"
							       value="<?php echo $item->post_title; ?>"/>
							<?php echo wp_video_shortcode( array( 'src' => wp_get_attachment_url( $file ) ) ); ?>
							<span class="dashicons dashicons-no"></span>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php } ?>