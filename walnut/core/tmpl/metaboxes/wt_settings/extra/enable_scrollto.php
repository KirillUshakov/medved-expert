<input type="checkbox" id="enable_scrollto" name="enable_scrollto" <?php echo isset( $data ) && $data ? 'checked="checked"' : ''; ?>/>
<label for="enable_scrollto"><?php _ex( 'Include ScrollTo?', 'Checkbox label', 'walnut' ); ?></label>
<p class="description">
	<?php _ex( 'Library that creates an anchor function with smooth scrolling on the page.', 'Description of library', 'walnut' ); ?>
</p>