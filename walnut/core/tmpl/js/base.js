(function( $ ) {
	$( document ).ready( function() {
		
		$( '.btn-top' ).on( 'click', function( e ) {
			e.preventDefault();
			$( 'html, body' ).animate( { scrollTop: 0 }, 750 );
			return false;
		} );
		
		$( 'a[href^="#"]' ).on( 'click', function( e ) {
			e.preventDefault();
			var selector;
			var id_name = $( this ).attr( 'href' );
			if( $( id_name ).length <= 0 ) {
				var class_name = id_name.replace( '#', '.' );
				if( class_name !== '.' && $( class_name ).length > 0 ) {
					selector = class_name;
				}
			} else {
				selector = id_name;
			}
			if( selector ) {
				$( 'html,body' ).animate( {
					scrollTop: $( selector ).offset().top - 65
				}, 750 );
			}
		} );
		
		//Call window modal for share links
		$( '.share-link' ).on( 'click', function( e ) {
			e.preventDefault();
			var link = $( this ).attr( 'href' );
			var title = $( this ).attr( 'title' );
			window.open( link, title, 'Toolbar=1,Location=0,Directories=0,Status=0,Menubar=0,Scrollbars=0,Resizable=0,Width=600,Height=400' );
		} );
		
		//Side-menu
		$( document ).on( 'click', '.side-menu-open', function( e ) {
			e.preventDefault();
			
			side_menu_close();
			
			$( '.side-menu' ).addClass( 'active' );
			$( '.side-menu-overlay' ).addClass( 'active' );
			$( 'body' ).addClass( 'side-menu-lock' );
			
			return false;
		} );
		
		$( document ).on( 'click', '.side-menu-close, .side-menu-overlay', function( e ) {
			if( e.currentTarget.className == e.target.className ) {
				e.preventDefault();
				side_menu_close();
				return false;
			}
			return true;
		} );
		
		function side_menu_close() {
			$( '.side-menu' ).removeClass( 'active' );
			$( '.side-menu-overlay' ).removeClass( 'active' );
			$( 'body' ).removeClass( 'side-menu-lock' );
		}
		
	} );
}( jQuery ));

//System functions

function alertObj( obj ) {
	var str, k;
	str = "";
	for( k in obj ) {
		str += k + ": " + obj[ k ] + "\r\n";
	}
	alert( str );
}