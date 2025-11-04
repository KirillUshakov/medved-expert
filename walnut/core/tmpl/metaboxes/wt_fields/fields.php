<a class="button button-primary button-large add-field"><?php _ex( 'Add field', 'Text for button', 'walnut' ); ?></a>
<div class="wt-fields">
	<?php if( isset( $fields ) && is_array( $fields ) && ! empty( $fields ) ) { ?>
		<?php foreach( $fields as $i => $field ) { ?>
			<div class="wt-field">
				<h4><?php _ex( 'Custom field', 'Title of field', 'walnut' ); ?></h4>
				<select name="fields[<?php echo $i; ?>][type]">
					<option value="text" <?php echo $field['type'] == 'text' ? 'selected' : ''; ?>><?php _ex( 'Text', 'Type of field', 'walnut' ); ?></option>
					<option value="confirm" <?php echo $field['type'] == 'confirm' ? 'selected' : ''; ?>><?php _ex( 'Confirm', 'Type of field', 'walnut' ); ?></option>
					<option value="image" <?php echo $field['type'] == 'image' ? 'selected' : ''; ?>><?php _ex( 'Image', 'Title of field', 'walnut' ); ?></option>
					<option value="images" <?php echo $field['type'] == 'images' ? 'selected' : ''; ?>><?php _ex( 'Images', 'Title of field', 'walnut' ); ?></option>
					<option value="file" <?php echo $field['type'] == 'file' ? 'selected' : ''; ?>><?php _ex( 'File', 'Title of field', 'walnut' ); ?></option>
					<option value="files" <?php echo $field['type'] == 'files' ? 'selected' : ''; ?>><?php _ex( 'Files', 'Title of field', 'walnut' ); ?></option>
					<option value="video" <?php echo $field['type'] == 'video' ? 'selected' : ''; ?>><?php _ex( 'Video', 'Title of field', 'walnut' ); ?></option>
					<option value="videos" <?php echo $field['type'] == 'videos' ? 'selected' : ''; ?>><?php _ex( 'Videos', 'Title of field', 'walnut' ); ?></option>
					<option value="rating" <?php echo $field['type'] == 'rating' ? 'selected' : ''; ?>><?php _ex( 'Rating', 'Title of field', 'walnut' ); ?></option>
				</select>
				<input type="text" name="fields[<?php echo $i; ?>][code]"
					   placeholder="<?php _ex( 'Code of field', 'Label for input', 'walnut' ); ?>"
					   value="<?php echo $field['code']; ?>">
				<label>
					<?php _ex( 'Required?', 'Title of field', 'walnut' ); ?>
					<input type="checkbox" name="fields[<?php echo $i; ?>][required]" value="1"
						<?php echo isset( $field['required'] ) && $field['required'] ? 'checked' : '' ?>/>
				</label>
				<input type="text" name="fields[<?php echo $i; ?>][label]"
					   placeholder="<?php _ex( 'Label of field', 'Label for input', 'walnut' ); ?>"
					   value="<?php echo $field['label']; ?>">

				<div class="field-delete">
					<span class="button-delete"><?php _e( 'Delete' ); ?></span>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<?php require_once get_template_directory() . '/core/tmpl/inc/field.php'; ?>
