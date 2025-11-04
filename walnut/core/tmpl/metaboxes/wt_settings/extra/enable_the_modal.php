<input type="checkbox" id="enable_the_modal" name="enable_the_modal" <?php echo isset( $data ) && $data ? 'checked="checked"' : ''; ?>/>
<label for="enable_the_modal"><?php _ex( 'Include The Modal?', 'Checkbox label', 'walnut' ); ?></label>
<p class="description">
	<?php _ex( 'Library that allows to run the modal windows.', 'Description of library', 'walnut' ); ?>
</p>