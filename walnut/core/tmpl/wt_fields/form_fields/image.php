<?php if( isset( $field ) && isset( $field['code'] ) ) { ?>
	<input type="file" name="<?php echo $this->add_prefix( $field['code'] ); ?>"
		id="<?php echo $this->add_prefix( $field['code'] ); ?>" accept="image/*"
		class="wt-form wt-form-image"
		<?php echo isset( $field['required'] ) && $field['required'] ? 'required' : '' ?> />
<?php } ?>