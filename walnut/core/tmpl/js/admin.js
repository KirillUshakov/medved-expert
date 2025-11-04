function renderMediaUploader( $item, multiple, code, mime, type ) {
	'use strict';
	
	var file_frame, image_data;
	
	var options = {
		multiple : multiple ? true : false
	};
	
	if( mime == undefined ) {
		mime = 'image';
		type = 'image';
	}
	
	if( mime ) {
		options.library = {
			type : mime
		};
	}
	
	file_frame = wp.media.frames.file_frame = wp.media( options );
	
	file_frame.on( 'select', function() {
		var selection = file_frame.state().get( 'selection' );
		var html = '';
		selection.map( function( item ) {
			item = item.toJSON();
			item.name = decodeURI( item.name );
			html += '<div class="mediafile attachment dashicons-container mediafile-' + type + '">';
			if( multiple ) {
				html += '<input type="hidden" name="' + code + '[' + item.id + '][title]" value="' + item.name + '" data-id="' + item.id + '" />';
			} else {
				html += '<input type="hidden" name="' + code + '" value="' + item.id + '" />';
			}
			if( type.indexOf( 'image' ) > -1 ) {
				html +=
					'<div class="attachment-preview landscape"><div class="thumbnail"><div class="centered">';
				if( 'sizes' in item && 'thumbnail' in item.sizes ) {
					html += '<img src="' + item.sizes.thumbnail.url + '" width="' + item.sizes.thumbnail.width + '" height="' + item.sizes.thumbnail.height + '" />';
				} else {
					html += '<img src="' + item.url + '" />';
				}
				html +=
					'</div><div class="filename"><div>' + item.name + '</div></div></div></div>';
			} else {
				html += '<a href="' + item.url + '" target="_blank">' + item.name + '</a>';
			}
			
			html += '<span class="dashicons dashicons-no"></span></div>';
		} );
		$item.html( html );
	} );
	
	file_frame.on( 'open', function() {
		var selection = file_frame.state().get( 'selection' );
		$item.find( '.mediafile input[type=hidden]' ).each( function() {
			if( multiple ) {
				selection.add( wp.media.attachment( jQuery( this ).data( 'id' ) ) );
			} else {
				selection.add( wp.media.attachment( jQuery( this ).val() ) );
			}
		} );
	} );
	
	file_frame.open();
}

(function( $ ) {
	$( document ).ready( function() {

		// Remove parent select in albums
		$( '.taxonomy-wt_gallery .term-parent-wrap' ).css( 'display', 'none' );
		
		// Testimonials meta box
		
		var mime_files = 'audio, image, video, application/pdf, application/msword, application/x-compressed, application/x-gzip, text/plain, application/vnd.ms-powerpoint, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
		var mime_images = 'image';
		var mime_videos = 'video';
		
		$( '.upload_header_logo' ).on( 'click', function( e ) {
			e.preventDefault();
			
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), false, 'header_logo' );
		} );
		
		$( '.upload_footer_logo' ).on( 'click', function( e ) {
			e.preventDefault();
			
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), false, 'footer_logo' );
		} );
		
		$( '.upload_favicon' ).on( 'click', function( e ) {
			e.preventDefault();
			
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), false, 'favicon' );
		} );
		
		$( '.upload_social' ).on( 'click', function( e ) {
			e.preventDefault();
			
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), false, $( this ).data( 'social' ) + '[icon]' );
		} );
		
		$( '.upload_file' ).on( 'click', function( e ) {
			e.preventDefault();
			var code = $( this ).data( 'code' );
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), false, code, mime_files, 'file' );
		} );
		
		$( '.upload_files' ).on( 'click', function( e ) {
			e.preventDefault();
			var code = $( this ).data( 'code' );
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), true, code, mime_files, 'files' );
		} );
		
		$( '.upload_image' ).on( 'click', function( e ) {
			e.preventDefault();
			var code = $( this ).data( 'code' );
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), false, code, mime_images, 'image' );
		} );
		
		$( '.upload_images' ).on( 'click', function( e ) {
			e.preventDefault();
			var code = $( this ).data( 'code' );
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), true, code, mime_images, 'images' );
		} );
		
		$( '.upload_video' ).on( 'click', function( e ) {
			e.preventDefault();
			var code = $( this ).data( 'code' );
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), false, code, mime_videos, 'video' );
		} );
		
		$( '.upload_videos' ).on( 'click', function( e ) {
			e.preventDefault();
			var code = $( this ).data( 'code' );
			renderMediaUploader( $( this ).siblings( '.uploaded-mediafiles' ), true, code, mime_videos, 'videos' );
		} );
		
		// Grid View Photos page
		
		function resize_photos() {
			var $content = $( '.media-frame-content' );
			var columns = 1;
			if( $content.width() > 2040 ) {
				columns = 12;
			} else if( $content.width() > 1870 ) {
				columns = 11;
			} else if( $content.width() > 1700 ) {
				columns = 10;
			} else if( $content.width() > 1530 ) {
				columns = 9;
			} else if( $content.width() > 1360 ) {
				columns = 8;
			} else if( $content.width() > 1190 ) {
				columns = 7;
			} else if( $content.width() > 1020 ) {
				columns = 6;
			} else if( $content.width() > 850 ) {
				columns = 5;
			} else if( $content.width() > 680 ) {
				columns = 4;
			} else if( $content.width() > 510 ) {
				columns = 3;
			} else if( $content.width() > 340 ) {
				columns = 2;
			} else {
				columns = 1;
			}
			$content.attr( 'data-columns', columns ).css( 'display', 'block' );
		}
		
		resize_photos();
		$( window ).resize( function() {
			resize_photos();
		} );
		
		// Link theme settings
		var $container;
		
		$( document ).on( 'click', ' .btn-link', function( e ) {
			e.preventDefault();
			$container = $( this ).parent().parent().parent();
			
			$( '#wp-link-text' ).val( $container.find( 'input.link-title' ).val() );
			$( '#wp-link-url' ).val( $container.find( 'input.link-href' ).val() );
			$( '#wp-link-target' ).prop( 'checked', $container.find( 'input.link-target' ).val() === '1' );
			
			wpActiveEditor = true;
			wpLink.open( $( this ).attr( 'data-id' ) );
			wpLink.newattr = $( this ).attr( 'data-id' );
			return false;
		} );
		
		$( document ).on( 'click', '.dashicons-no', function( e ) {
			$container = $( this ).parent().parent();
			
			$container.find( 'input.link-title' ).val( '' );
			$container.find( 'span.link-title' ).text( '' );
			
			$container.find( 'input.link-href' ).val( '' );
			$container.find( 'span.link-href' ).text( '' );
			
			$container.find( 'input.link-target' ).val( '' );
			$container.find( 'span.link-target' ).text( '' );
			
			$container.find( '.link-list' ).hide();
			$container.find( '.link-add' ).show();
			
			e.preventDefault ? e.preventDefault() : e.returnValue = false;
			e.stopPropagation();
			return false;
		} );
		
		$( document ).on( 'click', '#wp-link-cancel, #wp-link-close, #wp-link-backdrop', function( e ) {
			wpLink.textarea = $( 'body' );
			wpLink.close();
			e.preventDefault ? e.preventDefault() : e.returnValue = false;
			e.stopPropagation();
			return false;
		} );
		
		$( document ).on( 'click', '#wp-link-submit', function( e ) {
			var attrs = wpLink.getAttrs();
			
			if( $container ) {
				
				var title = $( '#wp-link-text' ).val();
				$container.find( 'input.link-title' ).val( title );
				$container.find( 'span.link-title' ).text( title );
				
				var href = attrs.href;
				$container.find( 'input.link-href' ).val( href );
				$container.find( 'span.link-href' ).text( href );
				
				var target = attrs.target;
				var target_text = dataTheme.link_opens + ' ';
				if( target ) {
					target_text += dataTheme.new_tab;
				} else {
					target_text += dataTheme.same_tab;
				}
				$container.find( 'input.link-target' ).val( target ? 1 : '' );
				$container.find( 'span.link-target' ).text( target_text );
				
				$container.find( '.link-list' ).show();
				$container.find( '.link-add' ).hide();
			}
			
			wpLink.textarea = $( 'body' );
			wpLink.close();
			e.preventDefault ? e.preventDefault() : e.returnValue = false;
			e.stopPropagation();
			return false;
		} );
		
		$( document ).on( 'click', '#search-results .item-title', function() {
			var $text = $( '#wp-link-text' );
			if( !$text.val() ) {
				$text.val( $( this ).text() );
			}
		} );
		
		//Delete mediafile in theme settings
		$( document ).on( 'click', '.mediafile .dashicons-no', function( e ) {
			$( this ).parent().remove();
		} );
		
		// Other scripts
		
		/*$( document ).on( 'click', '.remove-mediafile', function( e ) {
		 $( this ).parent().remove();
		 } );
		 
		 $( document ).on( 'click', '.view-files', function( e ) {
		 e.preventDefault();
		 $( this ).parent().find( 'input' ).trigger( 'click' );
		 } );
		 $( '.fileinput input[type=file]' ).change( function( e ) {
		 var value;
		 if( $( this ).attr( 'multiple' ) ) {
		 var files = $( this ).parent().find( 'input[type=file]:first' )[0].files;
		 if( files.length > 1 ) {
		 value = 'Число файлов: ' + files.length;
		 $( this ).parent().find( '.filelabel' ).html( value );
		 } else {
		 value = $( this ).val();
		 $( this ).parent().find( '.filelabel' ).html( getName( value ) );
		 }
		 } else {
		 value = $( this ).val();
		 $( this ).parent().find( '.filelabel' ).html( getName( value ) );
		 }
		 $( this ).parent().find( '.filedelete' ).css( 'display', 'block' );
		 } );
		 $( '.fileinput .filedelete' ).on( 'click', function() {
		 $( this ).parent().find( 'input[type=file]:first' ).val( '' );
		 $( this ).parent().find( '.filelabel' ).html( '' );
		 $( this ).parent().find( '.filedelete' ).css( 'display', 'none' );
		 } );*/
	} );
}( jQuery ));

function getName( str ) {
	var i, filename, uploaded;
	if( str.lastIndexOf( '\\' ) ) {
		i = str.lastIndexOf( '\\' ) + 1;
	} else {
		i = str.lastIndexOf( '/' ) + 1;
	}
	filename = str.slice( i );
	return filename;
}