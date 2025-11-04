<?php if( isset( $field ) && is_array( $field ) && ! empty( $field ) ) { ?>
	<div class="wt-field wt-text clearfix">
		<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label']; ?></label>
		<input type="text" name="<?php echo $this->add_prefix( $field['code'] ); ?>"
			id="<?php echo $this->add_prefix( $field['code'] ); ?>"
			value="<?php echo isset( $data ) ? esc_attr( $data ) : ''; ?>"/>
	</div>
<?php } ?>