<?php if( isset( $field ) && isset( $field['code'] ) ) { ?>
	<input type="file" name="<?php echo $this->add_prefix( $field['code'] ); ?>[]"
		id="<?php echo $this->add_prefix( $field['code'] ); ?>" accept="image/*"
		multiple class="wt-form wt-form-images"
		<?php echo isset( $field['required'] ) && $field['required'] ? 'required' : '' ?> />
<?php } ?>