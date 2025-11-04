(function ($) {
    if( typeof $.fn.inputmask !== 'undefined' && !initPhone ) {
      var initPhone = function( el ) {
        el.find( '[type=tel]' ).inputmask( '+7 (999) 999-99-99', {
          showMaskOnHover: false
        } );
      };
    }
    initPhone( $( 'section' ) );

    $(function () {
        var domain = 'medved-expert.ru';

        if (!$.cookie('city-selected') && typeof google !== 'undefined') {
            //Если город ещё не был выбран, находим местоположение и предлагаем перейти на домен города
            var geocoder = new google.maps.Geocoder();
            if ('geolocation' in navigator) {
                navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
            }

            // @TODO Is needed function ?
            function successFunction(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var latlng = new google.maps.LatLng(lat, lng);
                geocoder.geocode({'latLng': latlng}, function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results && 0 in results && 'formatted_address' in results[0]) {
                            if (typeof dataCities !== 'undefined' && dataCities && 'cities' in dataCities) {
                                $.each(dataCities.cities, function (key, value) {
                                    if ('name' in value && value.name && results[0].formatted_address.indexOf(value.name) > 1 && dataCities.current.name !== value.name) {
                                        $('.wt-dropdown .wt-dropdown-title span').text(value.name + '?');
                                        $('.wt-dropdown .wt-dropdown-success').attr('data-name', value.name).attr('href', value.url);
                                        $.fancybox.close(true);
                                        $('.wt-dropdown').slideDown('fast');
                                        $.cookie('city-selected', value.name, {
                                            expires: 7,
                                            path: '/',
                                            domain: domain
                                        });
                                    }
                                });
                            }
                        }
                    }
                });
            }

            function errorFunction() {
            }

        }

        $(document).on('click', '.wt-dropdown-success', function () {
            $.cookie('city-selected', $(this).attr('data-name'), {expires: 7, path: '/', domain: domain});
        });

        $(document).on('click', '.wt-dropdown-close', function () {
            $(this).closest('.wt-dropdown').slideUp('fast');
        });

        $(document).on('click', '.city-change-open', function (e) {
            e.preventDefault();
            ym(48605087, 'reachGoal', 'YOUR_CITY');
            $.fancybox.close(true);
            $.fancybox.open($('#wt-modal-city-change'), {touch: false});
        });

        $(document).on('click', '.callback-header-btn', function (e) {
          e.preventDefault();
          $.fancybox.close(true);
          $.fancybox.open($('#wt-modal-callback'), {
            touch: false,
            backFocus: false,
            animationEffect: 'zoom',
            afterLoad: function( instance, current ) {
              initPhone( $( current.$content[ 0 ] ) );
            }
          });
        });

        var vacanciesButton = '.wt-vacancies-head';
        var vacanciesList = '.wt-vacancies-list';
        var vacanciesContent = '.wt-vacancies-content';

        $(document).on('click', vacanciesButton, function (e) {
            e.preventDefault();
            if ($(this).parent().hasClass('active')) {
                $(this).parent().removeClass('active');
                $(this).siblings(vacanciesContent).slideUp(200);
            } else {
                $(this).closest(vacanciesList).find('li').removeClass('active');
                $(this).closest(vacanciesList).find(vacanciesContent).slideUp(200);
                $(this).parent().addClass('active');
                $(this).siblings(vacanciesContent).slideDown(200);
            }
        });
        $(vacanciesButton).eq(0).trigger('click');

        var $main = $('.wt-main');
        var $mjolnir = $('.wt-top');
        var $jarnbjorn = $('.wt-whatsapp');

        $(window).scroll(function () {
            //Скрываем кнопку, если высота контента на странице меньше 1200, иначе кнопка зависает в самом низу страницу
            if ($(document).height() < 1200) {
                $mjolnir.addClass('wt-top-hide');
            } else {
                $mjolnir.removeClass('wt-top-hide');
            }

            var top = $(document).scrollTop();
            var bottom = top + $(window).height();

            if (top > 50) {
                $mjolnir.addClass('wt-top-flying');
            } else {
                $mjolnir.removeClass('wt-top-flying wt-top-caught');
            }

            if ($(document).scrollTop() - 70 >= $('.wt-header').outerHeight(true)) {
                $jarnbjorn.addClass('wt-whatsapp-active');
            } else {
                $jarnbjorn.removeClass('wt-whatsapp-active');
            }

            var mainHeight = $main.offset().top + $main.outerHeight(true);

            if (bottom > mainHeight) {
                $mjolnir.addClass('wt-top-caught');
            } else {
                $mjolnir.removeClass('wt-top-caught');
            }
        });

        var $sticky = $('.wt-sticky');

        $(document).scroll(function () {
            if ($(document).scrollTop() - 70 >= $('.wt-header').outerHeight(true)) {
                $sticky.addClass('wt-sticky-active');
            } else {
                $sticky.removeClass('wt-sticky-active');
            }
        });

        $(document).on('click', '.comagic_phone, .comagic_call', function () {
            ym(48605087, 'reachGoal', 'CLICK_PHONE');
        });

    });

    // Change city
    $('[data-city-change]').on('click', (e, el) => {
        const btn = e.target.closest('[data-city-change]');
        const cityId = btn.dataset.cityId;

        e.preventDefault();

        document.cookie = `city_id=${ cityId }; path=/; max-age=31556926`;
        window.location.reload();
    })
})(jQuery);
