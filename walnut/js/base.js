(function( $ ) {
	$( document ).ready( function() {

		$( '.modal .close' ).on( 'click', function( e ) {
			e.preventDefault();
			$.modal().close();
		} );

		$( document ).on( 'click', '.modal-widget-open', function( e ) {
			e.preventDefault();
			$( '.modal-widget' ).modal().open();
		} );
		
		$( document ).on( 'click', '.modal-testimonial-open', function( e ) {
			e.preventDefault();
			$( '.modal-testimonial' ).modal().open();
		} );

	} );
}( jQuery ));