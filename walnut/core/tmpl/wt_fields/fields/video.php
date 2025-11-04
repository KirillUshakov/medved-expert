<?php if( isset( $field ) && is_array( $field ) && ! empty( $field ) ) { ?>
	<div class="wt-field wt-field-video">
		<?php echo wp_video_shortcode( array( 'src' => wp_get_attachment_url($field['value'] ) ) ); ?>
	</div>
<?php } ?>