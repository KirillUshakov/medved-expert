(function( $ ) {
	$( document ).ready( function() {

		//Add classes to rating input blocks in forms
		$( document ).on( 'change', '.wt-form-rating input', function() {
			var $this = $( this );
			var $block = $this.parent().parent();
			$block.find( 'label' ).removeClass( 'wt-form-item-checked' );
			$block.find( 'label' ).removeClass( 'wt-form-item-selected' );
			$block.find( 'label' ).slice( 0, $this.parent().index() + 1 ).addClass( 'wt-form-item-checked' );
			$this.parent().addClass( 'wt-form-item-selected' );
		} );
		
	} );
}( jQuery ));
