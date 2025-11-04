<div class="field-remove" style="display: none;">
	<div class="wt-field">
		<h4><?php _ex( 'Custom field', 'Title of field', 'walnut' ); ?></h4>
		<select name="type">
			<option value="text"><?php _ex( 'Text', 'Type of field', 'walnut' ); ?></option>
			<option value="confirm"><?php _ex( 'Confirm', 'Type of field', 'walnut' ); ?></option>
			<option value="image"><?php _ex( 'Image', 'Title of field', 'walnut' ); ?></option>
			<option value="images"><?php _ex( 'Images', 'Title of field', 'walnut' ); ?></option>
			<option value="file"><?php _ex( 'File', 'Title of field', 'walnut' ); ?></option>
			<option value="files"><?php _ex( 'Files', 'Title of field', 'walnut' ); ?></option>
			<option value="video"><?php _ex( 'Video', 'Title of field', 'walnut' ); ?></option>
			<option value="videos"><?php _ex( 'Videos', 'Title of field', 'walnut' ); ?></option>
			<option value="rating"><?php _ex( 'Rating', 'Title of field', 'walnut' ); ?></option>
		</select>
		<input type="text" name="code" placeholder="<?php _ex( 'Code of field', 'Label for input', 'walnut' ); ?>">
		<label>
			<?php _ex( 'Required?', 'Title of field', 'walnut' ); ?>
			<input type="checkbox" name="required" value="1"/>
		</label>
		<input type="text" name="label" placeholder="<?php _ex( 'Label of field', 'Label for input', 'walnut' ); ?>">

		<div class="field-delete">
			<span class="button-delete"><?php _e( 'Delete' ); ?></span>
		</div>
	</div>
</div>