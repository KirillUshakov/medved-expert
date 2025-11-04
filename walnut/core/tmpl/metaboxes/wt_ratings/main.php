<?php
	//avoid direct calls to this file where wp core files not present
	if( ! function_exists( 'add_action' ) ) {
		header( 'Status: 403 Forbidden' );
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
?>
<div>
	<?php if( isset( $post_types ) ) { ?>
		<h3><?php _ex( 'Select for which post types activate the ability to put stars', 'Help text for main ratings settings', 'walnut' ); ?></h3>
		<?php foreach( $post_types as $post_type ) { ?>
			<label>
				<input type="checkbox" name="post_types[]"
					   value="<?php echo $post_type->name; ?>" <?php if( in_array( $post_type->name, isset( $saved ) ? $saved : array() ) ) {
					echo 'checked';
				} ?> /><?php echo $post_type->labels->singular_name ? $post_type->labels->singular_name : $post_type->name; ?>
			</label>
		<?php } ?>
	<?php } ?>
</div>
