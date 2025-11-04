(function( $ ) {
	
	$( document ).ready( function() {
		
		$( '[data-fancybox]' ).fancybox( {
			loop: true,
			animationEffect: 'zoom',
			transitionEffect: 'slide',
			backFocus: false,
			buttons: [ 'slideShow', 'fullScreen', 'thumbs', 'download', 'zoom', 'close' ]
		} );
		
	} );
	
}( jQuery ));