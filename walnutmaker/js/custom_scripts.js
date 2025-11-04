$(document).ready(function () {
            initLazyLoading();
            //console.log('timeweb');
            $('.owl-stage-outer').each( function(e) { $(this).css('height','100%') } );

            $('#add_review').submit(function (e) {
                e.preventDefault();
                console.log($(this).serialize());
                //return;
                $.ajax({
                    type: 'POST',
                    url: '/wp-content/themes/walnutmaker/includes/add_review.php',
                    data: $(this).serialize(),
                    success: function(data)
                    {
                        //console.log(data); // show response from the php script.
                        if (data.indexOf('Ошибка') > -1) {
                            $('#review-error').html('<div style="color:red"><b>'+data+'</b></div>');
                        } else {
                            $('#review-error').html('<div style="color:green"><b>'+data+'</b></div>');
                            $('#add_review').each( function(e) { $(this).trigger('reset'); } )
                        }
                    }
                });
            });

            function timer() {
                var obj = document.getElementById('timer_inp');
                obj.innerHTML--;
                if (obj.innerHTML == 0) {
                    setTimeout(function () { }, 1000);
                    $('.time-clock').slideUp('slow');
                    $('#calc button').hide('slow');
                    $(".recalculate").show('slow');
                    $('.time-pro').show('fast');
                } else {
                    setTimeout(timer, 1000);
                }
            }

            $(document).ready(function () {
                $('.selSpos .item').on('click', function (c) {
                    $this = $(this);
                    $('.selSpos .item').removeClass('active');
                    $this.addClass('active');
                });
                $('.selSpos a').on('click', function () {
                    $this = $(this);
                    $('.selSpos .item').removeClass('active');
                    $this.parent().addClass('active');
                    return false;
                });
                $('.recalculate').on('click', function () {
                    var min = $('#mosc').hasClass('active') ? 13 : 21;
                    var max = $('#mosc').hasClass('active') ? 19 : 29;
                    var rand = Math.floor((Math.random() * 9) + 7);
                    var rand2 = Math.floor(Math.random() * (max - min + 1) + min);
                    $('.time-pro').hide();
                    if ($('.selSpos').has('.active').length == 0) {
                        $('.error').html('*Выберите, что нужно вскрыть').show('fast');
                    } else {
                        $('.error').html('');
                        $('#timer_inp').html(rand);
                        $('.time-r').html(rand2);
                        $('.time-clock').slideDown();
                        $('#calc button').hide('fast');
                        setTimeout(timer, 1000);
                    }
                });
                $('#calc button').on('click', function () {
                  var min = $('#mosc').hasClass('active') ? 13 : 21;
                  var max = $('#mosc').hasClass('active') ? 19 : 29;
                    var rand = Math.floor((Math.random() * 9) + 4);
                    var rand2 = Math.floor(Math.random() * (max - min + 1) + min);
                    if ($('.selSpos').has('.active').length == 0) {
                        $('.error').html('*Выберите, что нужно вскрыть').show('fast');
                    } else {
                        $('.time-pro').hide('fast');
                        $('.error').html('');
                        $('#timer_inp').html(rand);
                        $('.time-r').html(rand2);
                        $('.time-clock').slideDown();
                        $('#calc button').hide('fast');
                        setTimeout(timer, 1000);
                    }
                });
                $(".mosc.rayon ul li").on("click", function () {
                    $(".mosc.rayon ul li").removeClass("active");
                    $(this).addClass("active");
                });
                $(".podmosc.rayon ul li").on("click", function () {
                    $(".podmosc.rayon ul li").removeClass("active");
                    $(this).addClass("active");
                });
            });

            $('.mini-menu a').on('click', function () {
                $(this).addClass('active');
                $('.col3').slideDown('slow');
                return false;
            });
            $('.mini-menu a[value="mosc"]').on('click', function () {
                $(this).addClass('active');
                $('.podmosc').slideUp('slow');
                $('.mosc').slideDown('slow');
                $('.mini-menu a[value="podmosc"]').removeClass('active');
                return false;
            });
            $('.mini-menu a[value="podmosc"]').on('click', function () {
                $(this).addClass('active');
                $('.mosc').slideUp('slow');
                $('.podmosc').slideDown('slow');
                $('.mini-menu a[value="mosc"]').removeClass('active');
                return false;
            });


            $('#prev-scheme-steps').on('click', function () {
                $('#scheme-steps').animate({
                    scrollLeft: '-=300'
                }, 300, 'swing');
            });

            $('#next-scheme-steps').on('click', function () {
                $('#scheme-steps').animate({
                    scrollLeft: '+=300'
                }, 300, 'swing');
            });

            $( ".menu-item-has-children" ).hover(
                function() {
                    $( this ).find(".sub-menu").eq(0).show();
                }, function() {
                    $( this ).find(".sub-menu").eq(0).hide();
                }
            );


    var menuBtn = $('.messenger-btn'),
        menu    = $('.messenger-links');
    menuBtn.on('click', function() {
        if ( menu.hasClass('show') ) {
            menu.removeClass('show');
        } else {
            menu.addClass('show');
        }
    });

    $(document).mouseup(function (e){
        var div = $('.messenger');
        if (!div.is(e.target)
          && div.has(e.target).length === 0) {
            $('.messenger-links').removeClass('show');
        }
    });

    $('.input-file input[type=file]').on('change', function(){
        var file = this.files[0];
        $(this).closest('.input-file').find('.input-file-text').html(file.name);
    });


    var menuSearchBtn1 = $('ul#menu-nested-pages > li:last-child'),
        searchLine1    = $('.find-block');
    menuSearchBtn1.on('click', function() {
        if ( searchLine1.hasClass('show') ) {
            searchLine1.removeClass('show');
        } else {
            searchLine1.addClass('show');
        }
    });

    var menuSearchBtn2 = $('ul#menu-nested-pages-mob > li:last-child'),
        searchLine2    = $('.find-block-mob');
    menuSearchBtn2.on('click', function() {
        if ( searchLine2.hasClass('show') ) {
            searchLine2.removeClass('show');
        } else {
            searchLine2.addClass('show');
        }
    });

});
