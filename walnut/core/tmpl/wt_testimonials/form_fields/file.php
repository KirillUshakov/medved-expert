<?php if( isset( $field ) && isset( $field['code'] ) ) { ?>
	<input type="file" name="<?php echo $this->add_prefix( $field['code'] ); ?>"
		id="<?php echo $this->add_prefix( $field['code'] ); ?>"
		accept="audio/*, image/*, video/*, application/pdf, application/msword, application/x-compressed, application/x-gzip, text/plain, application/vnd.ms-powerpoint, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
		class="wt-form__field wt-form__field--file"
		<?php echo isset( $field['required'] ) && $field['required'] ? 'required' : '' ?> />
<?php } ?>