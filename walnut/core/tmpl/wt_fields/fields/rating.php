<?php if( isset( $field ) && isset( $field['value'] ) ) { ?>
	<div class="wt-field wt-field-rating">
		<?php for( $i = 1; $i < 6; $i++ ) { ?>
			<label class="wt-field-item <?php echo $field['value'] >= $i ? 'wt-field-item-checked' : ''; ?> <?php echo $field['value'] == $i ? 'wt-field-item-selected' : ''; ?>">
				<input type="radio" value="<?php echo $i; ?>"
					<?php echo $field['value'] == $i ? 'checked' : 'disabled'; ?>/>
			</label>
		<?php } ?>
	</div>
<?php } ?>