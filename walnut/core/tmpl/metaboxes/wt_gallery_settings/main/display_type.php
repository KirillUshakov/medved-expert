<?php
	//avoid direct calls to this file where wp core files not present
	if( ! function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
?>
<ul>
	<li>
		<label for="display_type-1">
			<input type="radio" name="display_type" id="display_type-1" value="gallery" <?php echo isset( $data ) &&
			$data == 'gallery' ? 'checked=checked' : ''; ?> />
			<span class="dashicons dashicons-format-gallery"></span>
			<?php _ex( 'Open photos in the adaptive gallery Fancybox 3', 'Radio label', 'walnut' ); ?>
		</label>
	</li>
	<li>
		<label for="display_type-2">
			<input type="radio" name="display_type" id="display_type-2" value="" <?php echo ! isset( $data ) ||
			! $data ? 'checked=checked' : ''; ?> />
			<span class="dashicons dashicons-format-image"></span>
			<?php _ex( 'Open photos on a separate page', 'Radio label', 'walnut' ); ?>
		</label>
	</li>
</ul>