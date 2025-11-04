(function( $ ) {
	$( document ).ready( function() {
		var $field = $( '.field-remove' );
		$field.remove();
		
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
			if( confirm( 'Are you sure you want to delete this field?' ) ) {
				$( this ).parent().parent().remove();
			}
		} );
		
	} );
})( jQuery );