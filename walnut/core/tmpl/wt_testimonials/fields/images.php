<?php if( isset( $field ) && is_array( $field ) && ! empty( $field ) ) { ?>
	<ul class="wt-field wt-field-images">
		<?php foreach( $field['value'] as $file ) { ?>
			<?php if( $file ) { ?>
				<li class="wt-field-item">
					<?php echo wp_get_attachment_image( $file, 'full' ); ?>
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
<?php } ?>