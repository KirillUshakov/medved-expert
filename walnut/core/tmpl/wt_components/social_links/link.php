<?php if ( isset( $data ) && isset( $data['link'] ) && isset( $data['icon'] ) ) { ?>
	<a href="<?php echo $data['link']; ?>" target="_blank">
		<img src="<?php echo wp_get_attachment_image_url( $data['icon'] ); ?>">
	</a>
<?php } ?>