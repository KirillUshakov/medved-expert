<?php if( isset( $field ) && isset( $field['code'] ) ) { ?>
	<input type="checkbox" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		   name="<?php echo $this->add_prefix( $field['code'] ); ?>" value="1"
		<?php echo isset( $field['required'] ) && $field['required'] ? 'required' : '' ?> />
<?php } ?>