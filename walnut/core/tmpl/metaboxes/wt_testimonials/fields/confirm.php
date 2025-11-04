<?php if( isset( $field ) && is_array( $field ) && ! empty( $field ) ) { ?>
	<div class="ti-field ti-confirm clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label']; ?></label>
		<input type="checkbox" id="<?php echo $this->add_prefix( $field['code'] ); ?>"
			id="<?php echo $this->add_prefix( $field['code'] ); ?>"
			name="<?php echo $this->add_prefix( $field['code'] ); ?>" value="1"
			<?php echo isset( $data ) && esc_attr( $data ) ? 'checked' : ''; ?> />
	</div>
<?php } ?>