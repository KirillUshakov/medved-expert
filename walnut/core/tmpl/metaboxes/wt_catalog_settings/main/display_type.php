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
			<input type="radio" name="display_type" id="display_type-1" value="sections" <?php echo isset( $data ) &&
			$data == 'sections' ? 'checked=checked' : ''; ?> />
			<span class="dashicons dashicons-list-view"></span>
			<?php _ex( 'Sections list', 'Radio label', 'walnut' ); ?>
		</label>
	</li>
	<li>
		<label for="display_type-2">
			<input type="radio" name="display_type" id="display_type-2" value="elements" <?php echo isset( $data ) &&
			$data == 'elements' ? 'checked=checked' : ''; ?> />
			<span class="dashicons dashicons-grid-view"></span>
			<?php _ex( 'Catalog elements', 'Radio label', 'walnut' ); ?>
		</label>
	</li>
	<li>
		<label for="display_type-3">
			<input type="radio" name="display_type" id="display_type-3" value="" <?php echo ! isset( $data ) ||
			! $data ? 'checked=checked' : ''; ?> />
			<span class="dashicons dashicons-editor-table"></span>
			<?php _ex( 'Combined', 'Radio label', 'walnut' ); ?>
		</label>
	</li>
</ul>
<p class="description">
	<?php _ex( 'Page of any section will display a list of child sections or elements list os section',
		'Description of field', 'walnut' ); ?>
</p>