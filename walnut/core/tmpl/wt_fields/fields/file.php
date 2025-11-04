<?php if( isset( $field ) && isset( $field['label'] ) && isset( $field['value'] ) && $field['value'] ) { ?>
	<div class="wt-field wt-field-file">
		<?php $item = get_post( $field['value'] ); ?>
		<a href="<?php echo wp_get_attachment_image_url( $data ); ?>" target="_blank">
			<?php echo $item->post_title; ?>
		</a>
	</div>
<?php } ?>