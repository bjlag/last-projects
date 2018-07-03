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
