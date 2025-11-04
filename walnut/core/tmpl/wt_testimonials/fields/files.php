<?php if( isset( $field ) && isset( $field['value'] ) ) { ?>
	<ul class="wt-field wt-field-files">
		<?php foreach( $field['value'] as $file ) { ?>
			<?php if( $file ) { ?>
				<li class="wt-field-item">
					<?php $item = get_post( $file ); ?>
					<a href="<?php echo wp_get_attachment_image_url( $file ); ?>" target="_blank">
						<?php echo $item->post_title; ?>
					</a>
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
<?php } ?>