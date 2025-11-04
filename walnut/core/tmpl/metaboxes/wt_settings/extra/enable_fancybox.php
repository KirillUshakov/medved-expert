<input type="checkbox" id="enable_fancybox" name="enable_fancybox" <?php echo isset( $data ) && $data
	? 'checked="checked"' : ''; ?>/>
<label for="enable_fancybox"><?php _ex( 'Include Fancybox 3?', 'Checkbox label', 'walnut' ); ?></label>
<p class="description">
	<?php _ex( 'The library allows to run modal windows, and also creates adaptive image galleries.',
		'Description of library', 'walnut' ); ?>
</p>