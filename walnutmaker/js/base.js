(function( $ ) {
  contentLoadedHandler();
  initLazyLoading();

	$( function() {

		// Mask for phone input
		if( typeof $.fn.inputmask !== 'undefined' ) {
			var initPhone = function( el ) {
				el.find( '[type=tel]' ).inputmask( '+7 (999) 999-99-99', {
					showMaskOnHover: false
				} );
			};
		}
		initPhone( $( 'section' ) );

		//Small hacks for styling some html elements
		$( 'table' ).wrap( '<div class="table-responsive table-full">' );
		$( '.wt-styles p' ).has( 'img' ).addClass( 'wt-styles-image' );
		$( '.wt-styles p' ).has( 'iframe' ).addClass( 'wt-styles-iframe' );

		//Adaptive side menu
		var $sidenav = $( '.wt-sidenav' );
		var wt_sidenav_close = function() {
			$sidenav.removeClass( 'active' );
			$( '.wt-sidenav-overlay' ).removeClass( 'active' );
			$( 'body' ).removeClass( 'wt-sidenav-lock' );
		};
		var wt_sidenav_open = function() {
			wt_sidenav_close();
			$sidenav.addClass( 'active' );
			$( '.wt-sidenav-overlay' ).addClass( 'active' );
			$( 'body' ).addClass( 'wt-sidenav-lock' );
		};
		$( document ).on( 'click', '.wt-sidenav-open', function( e ) {
			e.preventDefault();
			wt_sidenav_open();
			return false;
		} );
		var sidenav_close_pack = '.wt-sidenav-close, .wt-sidenav-overlay';
		$( document ).on( 'click', sidenav_close_pack, function( e ) {
			if( $( this ).is( sidenav_close_pack ) || $( this ).closest( '.wt-sidenav-close' ).length ) {
				e.preventDefault();
				wt_sidenav_close();
				return false;
			}
			return true;
		} );

		//Native side menu
		function allowSwipe( $target ) {
			var excludedElements = [ '.owl-carousel', '.table-responsive', '.fancybox-container' ];
			var swipe = true;
			excludedElements.forEach( function( el ) {
				if( $target === $( el ) || $target.closest( el ).length ) {
					swipe = false;
				}
			} );
			return swipe;
		}

		$( '.wt-sidenav, .wt-sidenav-overlay' ).on( 'swipeleft', function() {
			if( $( document ).outerWidth() < 1200 && $sidenav.hasClass( 'active' ) && $sidenav.hasClass( 'wt-sidenav-left' ) ) {
				wt_sidenav_close();
			}
		} ).on( 'swiperight', function() {
			if( $( document ).outerWidth() < 1200 && $sidenav.hasClass( 'active' ) && $sidenav.hasClass( 'wt-sidenav-right' ) ) {
				wt_sidenav_close();
			}
		} );
		$( document ).on( 'swipeleft', function( e ) {
			if( allowSwipe( $( e.target ) ) && $( document ).outerWidth() < 1200 && !$sidenav.hasClass( 'active' ) && $sidenav.hasClass( 'wt-sidenav-right' ) ) {
				wt_sidenav_open();
			}
		} ).on( 'swiperight', function( e ) {
			if( allowSwipe( $( e.target ) ) && $( document ).outerWidth() < 1200 && !$sidenav.hasClass( 'active' ) && $sidenav.hasClass( 'wt-sidenav-left' ) ) {
				wt_sidenav_open();
			}
		} );

		// Fancybox for modal windows
		if( typeof $.fn.fancybox !== 'undefined' ) {
			var thanks = function() {
				$.fancybox.close( true );
				$.fancybox.open( $( '.wt-modal-thanks' ) );
			};
			$( '.callback-open, .modal-open' ).fancybox( {
        defaultType: 'inline',
				touch: false,
				backFocus: false,
				animationEffect: 'zoom',
				afterLoad: function( instance, current ) {
					initPhone( $( current.$content[ 0 ] ) );
				}
			} );

			document.addEventListener( 'wpcf7mailsent', function() {
				ym( 48605087, 'reachGoal', 'SEND_REQUEST' );
				thanks();
			}, false );
		}

	} );

	// Owl carousel for sliders
	if( typeof $.fn.owlCarousel !== 'undefined' ) {
		$( window ).on( 'load', function() {
      $( '.wt-triggers-wrap' ).each( function() {
        var options = $( this ).data( 'options' );
        var speed = $( this ).data( 'speed' );
        var interval = $( this ).data( 'interval' );
        var cols = $( this ).data( 'cols' );
        var $carousel = $( this ).owlCarousel( {
          onInitialized: updatedHtmlHandler,
          items: 1,
          mouseDrag: false,
          autoHeight: true,
          nav: false,
          navText: '',
          navElement: 'button',
          autoplayTimeout: interval ? interval : 5000,
          autoplaySpeed: speed ? speed : 500,
          dots: $.inArray( 'dots', options ) > -1,
          navSpeed: speed ? speed : 500,
          dotsSpeed: speed ? speed : 500,
          loop: $.inArray( 'loop', options ) > -1,
          responsive: {
            768: {
              items: 2,
            },
            992: {
              items: cols,
              nav: $.inArray( 'arrows', options ) > -1,
              loop: false,
              autoplayTimeout: interval ? interval : 5000,
              autoplaySpeed: speed ? speed : 500
            }
          },
          onChanged: callBack,
        } );

        var $window = $( window );
        var $document = $( document );
        var inView = false;

        $window.on( 'scroll', function() {
          if ( ! inView && $carousel.length && isScrolledIntoView( $carousel ) ) {
            console.log(interval);
            $carousel.trigger( 'play.owl.autoplay', [ interval, speed ] );
            /*$carousel.on( 'changed.owl.carousel', function( event ) {
              if ( event.property.name === 'position' && event.relatedTarget.current() === event.relatedTarget.maximum() ) {
                $carousel.trigger( 'stop.owl.autoplay' );
              }
            } );*/
            inView = true;
          }
        } );
        function callBack(event) {
          if($carousel) {
            var current = (event.item.index + 1) - event.relatedTarget._clones.length / 2;
            if( current) {
              $carousel.trigger('stop.owl.autoplay');
              $carousel.trigger( 'play.owl.autoplay', [ interval, speed ] );
            }
          }
        }

        function isScrolledIntoView( elem ) {
          var docViewTop = $window.scrollTop();
          var docViewBottom = docViewTop + $window.height();
          var elemTop = elem.offset().top;
          var elemBottom = elemTop + elem.height();
          return ( elemBottom <= docViewBottom ) && ( elemTop >= docViewTop );
        }
      } );

			$( '.wt-slider-testimonials-wrap' ).each( function() {
				var options = $( this ).data( 'options' );
				var speed = $( this ).data( 'speed' );
				var interval = $( this ).data( 'interval' );
				var cols = $( this ).data( 'cols' );
				$( this ).owlCarousel( {
          onInitialized: updatedHtmlHandler,
					items: 1,
					mouseDrag: false,
					autoHeight: true,
					nav: false,
					navText: '',
          navElement: 'button',
					autoplay: false,
					dots: $.inArray( 'dots', options ) > -1,
					navSpeed: speed ? speed : 500,
					dotsSpeed: speed ? speed : 500,
					responsive: {
						992: {
							items: cols,
							loop: $.inArray( 'loop', options ) > -1,
							nav: $.inArray( 'arrows', options ) > -1,
							autoplay: $.inArray( 'auto', options ) > -1,
							autoplayTimeout: interval ? interval : 5000,
							autoplaySpeed: speed ? speed : 500
						}
					}
				} );
			} );
			$( '.wt-sidebar-triggers-wrap, .wt-slider-banners-wrap' ).each( function() {
				var options = $( this ).data( 'options' );
				var speed = $( this ).data( 'speed' );
				var interval = $( this ).data( 'interval' );
				$( this ).owlCarousel( {
          onInitialized: updatedHtmlHandler,
					items: 1,
					mouseDrag: false,
					autoHeight: true,
					nav: false,
					navText: '',
					autoplay: false,
					dots: $.inArray( 'dots', options ) > -1,
					navSpeed: speed ? speed : 500,
					dotsSpeed: speed ? speed : 500,
					responsive: {
						992: {
							loop: $.inArray( 'loop', options ) > -1,
							nav: $.inArray( 'arrows', options ) > -1,
							autoplay: $.inArray( 'auto', options ) > -1,
							autoplayTimeout: interval ? interval : 5000,
							autoplaySpeed: speed ? speed : 500
						}
					}
				} );
			} );
		} );
	}

})( jQuery );

// Lazy loading
function updatedHtmlHandler () {
  requestAnimationFrame(() => {
    initLazyLoading();
  });
}
function getLazyElementsOffsetTop (elements) {
  const result = [];

  elements.forEach(el => {
    const getOffset = (elem, direction = 'top') => {
      const rect = elem.getBoundingClientRect();
      return rect[direction] + window.pageYOffset;
    };

    const offsetTop = Math.round(getOffset(el, 'top'));
    const offsetBottom = Math.round(offsetTop + el.offsetHeight);
    const existBreakpointIndex = result.findIndex(el => el.offsetTop == offsetTop && el.offsetBottom == offsetBottom);

    el.dataset.offsetTop = offsetTop;
    el.dataset.offsetBottom = offsetBottom;

    if (existBreakpointIndex != -1) {
      result[existBreakpointIndex].elements.push(el);
    } else {
      result.push({
        offsetTop: offsetTop,
        offsetBottom: offsetBottom,
        elements: [el],
      });
    }
  });

  return result;
}
function initLazyLoading (dontInitPopup = true) {
  const filterLazyElements = (elements) => {
    if (!dontInitPopup) return elements;

    const arr = [...elements];
    return arr.filter(el => !el.closest('.popup'));
  }
  const lazyImages = filterLazyElements(document.querySelectorAll('[data-src]'));
  const lazyBackgrounds = filterLazyElements(document.querySelectorAll('[data-background-image]'));
  const lazyImagesPositions = getLazyElementsOffsetTop(lazyImages);
  const lazyBackgroundPositions = getLazyElementsOffsetTop(lazyBackgrounds);
  const lazyLoadOffset = window.innerHeight + 350;

  const loadLazyElements = (elements, setAttrName, dataAttrName, prefix = '', postfix = '') => {
    let allElements =  elements;

    if (!dontInitPopup) {
      allElements = [...document.querySelectorAll(`.popup [data-${dataAttrName}]`)];
    }

    allElements.forEach(el => {
      if (el.dataset[dataAttrName]) {
        el.setAttribute(setAttrName, prefix + el.dataset[dataAttrName] + postfix);
        el.removeAttribute(`data-${dataAttrName}`);
      }
    });
  }
  const checkLazyImagesPos = (event) => {
    const scrolledTop = document.documentElement.scrollTop || document.body.scrollTop;

    lazyImagesPositions.forEach((position, positionIndex) => {
      const loadingTriggerTop = position.offsetTop - lazyLoadOffset;
      const loadingTriggerBottom = position.offsetBottom + lazyLoadOffset

      if (loadingTriggerBottom >= scrolledTop && scrolledTop >= loadingTriggerTop) {
        loadLazyElements(position.elements, 'src', 'src');
        lazyImagesPositions.splice(positionIndex, 1);
      }
    });
  }
  const checkLazyBackgroundPos = (event) => {
    const scrolledTop = document.documentElement.scrollTop || document.body.scrollTop;

    lazyBackgroundPositions.forEach((position, positionIndex) => {
      const loadingTriggerPos = position.offsetTop - lazyLoadOffset;

      if (scrolledTop >= loadingTriggerPos) {
        loadLazyElements(position.elements, 'style', 'backgroundImage', 'background-image: url(', ');');
        lazyBackgroundPositions.splice(positionIndex, 1);
      }
    });
  }
  const checkLazyElementsHandler = () => {
    checkLazyImagesPos();
    checkLazyBackgroundPos();
  }

  if (!dontInitPopup) {
    loadLazyElements([], 'src', 'src');
    loadLazyElements([], 'style', 'backgroundImage', 'background-image: url(', ');');
    return;
  }

  window.onscroll = checkLazyElementsHandler;
  checkLazyElementsHandler();
  setTimeout(() => checkLazyElementsHandler());
}

function contentLoadedHandler () {
  const body = document.querySelector('body');
  body.classList.remove('no-js');
}
