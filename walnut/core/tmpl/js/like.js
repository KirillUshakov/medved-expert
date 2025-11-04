(function( $ ) {
	$( document ).ready( function() {

		//Ajax function for like or unlike post
		$( document ).on( 'change', '.like input', function() {
			var $this = $( this );
			var $block = $this.parent();
			var data = {
				action : 'wt_like',
				nonce : dataLikes.nonce,
				id : $block.attr( 'data-post-id' )
			};
			$.post( dataLikes.url, data, function( response ) {
				console.log( response );
				if( response.success ) {
					var $count = $block.find( '.like__count' );
					if( response.data.type == 'like' ) {
						$count.html( parseInt( $count.html() ) + 1 );
						$block.addClass( 'liked' );
					} else if( response.data.type == 'unlike' ) {
						$count.html( parseInt( $count.html() ) - 1 );
						$block.removeClass( 'liked' );
					}
				} else {
					alert( response.data );
				}
			} );
		} );
		
	} );
}( jQuery ));
