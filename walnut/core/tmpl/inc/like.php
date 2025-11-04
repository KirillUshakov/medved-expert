<label class="like <?php echo isset( $liked ) && $liked ? 'liked' : ''; ?>"
	   data-post-id="<?php echo $post_id; ?>">
	<?php if( isset( $text_before ) && $text_before ) { ?>
		<span class="like__before"><?php echo $text_before; ?></span>
	<?php } ?>
	<input type="checkbox" <?php echo isset( $liked ) && $liked ? 'checked' : ''; ?>>
	<span class="like__count">
		<?php echo isset( $likes ) && is_array( $likes ) && ! empty( $likes ) ? count( $likes ) : 0; ?>
	</span>
	<?php if( isset( $text_after ) && $text_after ) { ?>
		<span class="like__after"><?php echo $text_after; ?></span>
	<?php } ?>
</label>