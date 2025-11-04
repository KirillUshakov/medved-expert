<?php if( isset( $field ) && is_array( $field ) && ! empty( $field ) ) { ?>
	<ul class="wt-field wt-field-videos">
		<?php foreach( $field['value'] as $file ) { ?>
			<?php if( $file ) { ?>
				<li class="wt-field-item">
					<?php echo wp_video_shortcode( array( 'src' => wp_get_attachment_url( $file ) ) ); ?>
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
<?php } ?>