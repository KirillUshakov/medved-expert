<?php wt_testimonials_form_open(); ?>

	<div class="wt-group wt-group-content">
		<label for="post_content"><?php _e( 'Content' ); ?></label>
		<?php wt_testimonials_form_content( true, __( 'Content' ) ); ?>
	</div>

<?php $fields = wt_testimonials_form_fields( false ); ?>
<?php if( $fields ) { ?>
	<?php foreach( $fields as $field ) { ?>
		<div
			class="wt-group wt-group-<?php echo $field['type']; ?>">
			<label for="<?php echo $this->add_prefix( $field['code'] ); ?>"><?php echo $field['label']; ?></label>
			<?php wt_testimonials_form_field( $field['code'] ); ?>
		</div>
	<?php } ?>
<?php } ?>

	<div class="btn btn-main"><?php wt_testimonials_form_submit(); ?></div>

<?php wt_testimonials_form_close(); ?>