<?php if( isset( $field ) && is_array( $field ) && ! empty( $field ) ) { ?>
	<div class="wt-field wt-field-image">
		<?php echo wp_get_attachment_image( $field['value'], 'full' ); ?>
	</div>
<?php } ?>