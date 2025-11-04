<?php $fields = wt_testimonials_form_fields( false ); ?>
<?php if( $fields ) { ?>
	<?php foreach( $fields as $field ) { ?>
		<div class="wt-group wt-group-<?php echo $field['type']; ?>">
			<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label']; ?></label>
			<?php wt_testimonials_form_field( $field['code'] ); ?>
		</div>
	<?php } ?>
<?php } ?>
