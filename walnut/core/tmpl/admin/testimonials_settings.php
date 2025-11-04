<div class="wrap wp_theme_settings">
	<h1><?php _ex( 'Testimonial Settings', 'Title on settings page', 'walnut' ); ?></h1>

	<form method="post" enctype="multipart/form-data"
		  action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">
		<?php
			wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
			wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
		?>
		<div id="poststuff" class="testimonials">
			<div id="post-body"
				 class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">
				<div id="postbox-container-1" class="postbox-container">
					<div id="submitdiv" class="postbox">
						<h3><?php _e( 'Editing data', 'walnut' ); ?></h3>

						<div id="major-publishing-actions">
							<div id="publishing-action">
								<input type="submit" name="submit" id="submit" class="button button-primary"
									   value="<?php _e( 'Save Changes' ); ?>">
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<?php //do_meta_boxes( $this->pagehook, 'side', null ); ?>
				</div>
				<div id="postbox-container-2" class="postbox-container">
					<?php do_meta_boxes( $this->pagehook, 'normal', null ); ?>
					<!-- Here is a content after normal meta boxes and before advanced meta boxes -->
					<?php do_meta_boxes( $this->pagehook, 'advanced', null ); ?>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<?php submit_button(); ?>
	</form>
</div>
<?php require_once get_template_directory() . '/core/tmpl/inc/field.php'; ?>
<script type="text/javascript">
	//<![CDATA[
	jQuery( document ).ready( function( $ ) {
		// close postboxes that should be closed
		$( '.if-js-closed' ).removeClass( 'if-js-closed' ).addClass( 'closed' );
		// postboxes setup
		postboxes.add_postbox_toggles( '<?php echo $this->pagehook; ?>' );
	} );
	//]]>

	(function( $ ) {
		$( document ).ready( function() {
			var $field = $( '.field-remove' );
			//$field.remove();

			$( '.add-field' ).on( 'click', function( e ) {
				e.preventDefault();
				var date = new Date();
				var id = date.getTime();
				var $fields = $( this ).parent().find( '.wt-fields' ).append( $field.html() );
				$fields.find( '.wt-field' ).last().find( 'select,input' ).each( function() {
					$( this ).attr( 'name', 'fields[' + id + '][' + $( this ).attr( 'name' ) + ']' );
				} );

			} );

			$( document ).on( 'click', '.button-delete', function() {
				if( confirm( '<?php _ex( 'Are you sure you want to delete this field?', 'Popup message by deleting field', 'walnut' ); ?>' ) ) {
					$( this ).parent().parent().remove();
				}
			} );

		} );
	}( jQuery ));
</script>