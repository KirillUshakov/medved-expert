<?php if( isset( $field ) && is_array( $field ) && ! empty( $field ) ) { ?>
	<div class="ti-field ti-rating clearfix">
		<label><?php echo $field['label']; ?></label>
		<div class="ti-rating__container">
			<?php for( $i = 1; $i < 6; $i ++ ) { ?>
				<label for="<?php echo $this->add_prefix( $field['code'] ); ?>-<?php echo $i; ?>">
					<input type="radio" id="<?php echo $this->add_prefix( $field['code'] ); ?>-<?php echo $i; ?>"
					       name="<?php echo $this->add_prefix( $field['code'] ); ?>"
					       value="<?php echo $i; ?>" <?php echo isset( $data ) && $data == $i ? 'checked' : ''; ?> />
				</label>
			<?php } ?>
		</div>
	</div>
<?php } ?>