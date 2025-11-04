(function( $ ) {
	$( document ).ready( function() {

		//Ajax function for rating post
		$( document ).on( 'change', '.wt-rating input', function() {
			var $this = $( this );
			var $block = $this.parent().parent();
			var data = {
				action : 'wt_rating',
				nonce : dataRatings.nonce,
				id : $block.attr( 'data-post-id' ),
				star : $this.val()
			};
			$.post( dataRatings.url, data, function( response ) {
				if( response.success ) {
					$block.find( 'label' ).removeClass( 'wt-rating-active' );
					$block.find( 'label' ).slice( 0, $this.parent().index() + 1 ).addClass( 'wt-rating-active' );
				} else {
					alert( response.data );
				}
			} );
		} );
		
	} );
}( jQuery ));
