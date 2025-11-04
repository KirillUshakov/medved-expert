<?php if( isset( $field ) && isset( $field['code'] ) ) { ?>
	<div class="wt-form wt-form-rating">
		<?php for( $i = 1; $i < 6; $i++ ) { ?>
			<label for="<?php echo $this->add_prefix( $field['code'] ); ?>-<?php echo $i; ?>"
				class="wt-form-item">
				<input type="radio" id="<?php echo $this->add_prefix( $field['code'] ); ?>-<?php echo $i; ?>"
					name="<?php echo $this->add_prefix( $field['code'] ); ?>" value="<?php echo $i; ?>"
					<?php echo isset( $field['required'] ) && $field['required'] ? 'required' : '' ?> />
			</label>
		<?php } ?>
	</div>
<?php } ?>