'use strict';
var app = {};

/**
 * Слайдер альбомов в фотогалереи
 */
;( function ( obj ) {
    obj.gallerySlider = obj.gallerySlider || {};

    obj.gallerySlider.init = function () {
        var gallery = $( '.js__gallery-slider' );

        gallery.slick( {
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: true,
            fade: true,
            cssEase: 'linear'
        } );

        /**
         * При изменении размера слайдера подстраивать положение кнопок перелистывания слайдов: prev, next
         */
        gallery.on( 'setPosition', function () {
            var height = gallery.find( '.gallery-slider__img' ).height(),
                arrow = gallery.find( '.slick-arrow' ),
                padding = 15,
                top = height / 2 + padding;

            arrow.css( {
                'top': top
            } );
        } );
    }
} )( app );

/**
 * Верхнее меню
 */
;( function ( obj ) {
    obj.menuTop = obj.menuTop || {};

    obj.menuTop.init = function () {
        var $trigger = $( '.js__menu-trigger' ),
            $menu = $( '#menu-top' ),
            $triggerSubmenu = $menu.find( '.menu-top--submenu > a' );

        $trigger.on( 'click', function ( e ) {
            e.preventDefault();
            $trigger.find( '.hamburger' ).toggleClass( 'is-active' );
            $menu.slideToggle( 300, function () {
                // $menu.css( { 'display': '' } );
            } );

            // console.log( $menu.cssProps );
        } );

        $triggerSubmenu.on( 'click', function ( e ) {
            var sizeLg = 979;

            if ( $( document ).width() < sizeLg ) {
                e.preventDefault();

                $( this ).parent().toggleClass( 'menu-top--submenu-open' );
                $( this ).parent().find( 'ul.menu-top__submenu' ).slideToggle( 300 );
            }
        } );
    }
} )( app );

/**
 * Отзывы
 */
;(function ( obj ) {
    obj.reviews = obj.reviews || {};

    obj.reviews.init = function () {
        $( '.js__reviews' ).slick( {
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: true
            // autoplay: true,
            // autoplaySpeed: 2000,

            /*
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]*/
        } );
    }
})( app );

/**
 * Слайдер номеров
 */
;(function ( obj ) {
    obj.roomsSlider = obj.roomsSlider || {};

    obj.roomsSlider.init = function () {
        $( '.js__rooms-slider-images' ).slick( {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            asNavFor: '.js__rooms-slider-desc'
        } );

        $( '.js__rooms-slider-desc' ).slick( {
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.js__rooms-slider-images',
            fade: true,
            arrows: false,
            adaptiveHeight: true
        } );
    }
})( app );

;(function ( obj ) {
    obj.sliderSingle = obj.sliderSingle || {};

    obj.sliderSingle.init = function () {
        $( '.js__slider-single' ).slick( {
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            responsive: [
                {
                    breakpoint: 569,
                    settings: {
                        dots: false
                    }
                }
            ]
        } );
    }
})( app );

/**
 * Слайдер специальных предложений
 */
;( function ( obj ) {
    obj.specialOffers = obj.specialOffers || {};

    obj.specialOffers.init = function () {
        $( '.js__special-offers' ).slick( {
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 978,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 569,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        } );
    };
} )( app );

/**
 * Инициализация приложения
 */
$( function () {
    app.menuTop.init();
    app.reviews.init();
    app.roomsSlider.init();
    app.specialOffers.init();
    app.sliderSingle.init();
    app.gallerySlider.init();
} );

/**
 * Поиск доступных номеров на выбранные даты
 * @param nfrom - имя атрибута name поля input, дата заезда
 * @param nto - имя атрибута name поля input, дата выезда
 * @returns {boolean}
 */
function wb_open_w( nfrom, nto ) {
    var df, dt, dft, dtt;

    df = $( 'input[name=' + nfrom + ']' ).val().replace( /\./gi, "/" );
    dt = $( 'input[name=' + nto + ']' ).val().replace( /\./gi, "/" );

    if ( !df ) {
        df = get_cur_dat( 0 );
    }
    if ( !dt ) {
        dt = get_cur_dat( 1 );
    }

    dft = new Date( parseInt( df.substr( 6, 4 ) ), parseInt( df.substr( 3, 2 ) ) - 1, parseInt( df.substr( 0, 2 ) ), 0, 0, 0, 0 );
    dtt = new Date( parseInt( dt.substr( 6, 4 ) ), parseInt( dt.substr( 3, 2 ) ) - 1, parseInt( dt.substr( 0, 2 ) ), 0, 0, 0, 0 );

    if ( dft.getTime() >= dtt.getTime() ) {
        WuBook.open( { lang: 'ru', layout: 'parkinn', dfrom: df, nights: 1 } );
        return false;
    } else {
        WuBook.open( { lang: 'ru', layout: 'parkinn', dfrom: df, dto: dt } );
        return false;
    }
}
