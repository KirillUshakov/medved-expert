<?php if( isset( $field ) && isset( $field['code'] ) ) { ?>
	<input type="text" name="<?php echo $this->add_prefix( $field['code'] ); ?>"
		id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		placeholder="<?php echo $field['label']; ?>" class="wt-form wt-form-text"
		<?php echo isset( $field['required'] ) && $field['required'] ? 'required' : '' ?> />
<?php } ?>