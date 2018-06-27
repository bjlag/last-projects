'use strict';

var app = {
    init: function() {
        this.hamburger();
        this.mobileMenu();
        this.form();
        this.heightBlock();
        this.anchor();
        this.sliderCertificates();
        this.sliderAwards();
        this.scroll();
        this.ym.onEvent();
    },

    ym: {
        /**
         * Ловим событие 'click' по элементам интерфейса помеченные атрибутом data-ym
         */
        onEvent: function() {
            var self = this;

            $( '[data-ym]' ).on( 'click', function() {
                var event = $( this ).attr( 'data-ym' );
                self.send( event );
            } );
        },

        /**
         * Отправляем событие reachGoal в Яндекс.Метрику
         * @param event - ID события
         * @returns {boolean}
         */
        send: function ( event ) {
            yaCounter16960375.reachGoal( event );
            return true;
        },

        /**
         * @param id - ID формы
         */
        sendById: function ( id ) {
            var events = {
                'form-modal-callback': 'FORM_CALLBACK_SEND',
                'form-modal-price': 'FORM_PRICE_SEND',
                'form-modal-discount': 'FORM_DISCOUNT_SEND',
                'form-feedback': 'FORM_FEEDBACK_SEND'
            };

            if ( events[ id ] ) {
                this.send( events[ id ] );
            }
        }
    }
};

/**
 * Устанавливаем одинаковую высоту блоков
 */
app.heightBlock = function() {
    $( '.js-catalog-preview-main' ).matchHeight();
};

/**
 * Работа с формами
 */
app.form = function() {
    // маска
    $( 'input[name="phone"]' ).mask( '+7 (999) 999-9999' );

    // отправка формы
    $( '.js-form' ).on( 'submit', function ( e ) {
        e.preventDefault();

        var form = $( this ),
            action = form.attr( 'action' ),
            method = form.attr( 'method' ),
            formId = form.attr( 'id' ),
            data = form.serialize(),
            required = form.find( '.js-required' ),
            //yaEventSendId = form.attr( 'data-ya-event-send' ),
            isError = false;

        // валидация
        $.each( required, function ( index, value ) {
            if ( value.value.trim() === '' ) {
                $( value ).closest( '.form-group' ).addClass( 'has-error' );
                isError = true;

            } else if ( value.type === 'checkbox' && !value.checked ) {
                $( value ).closest( '.checkbox' ).addClass( 'has-error' );
                isError = true;

            } else if ( value.name === 'email' ) {
                var rule = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i;

                if ( !rule.test( value.value ) ) {
                    $( value ).closest( '.form-group' ).addClass( 'has-error' );
                    isError = true;
                } else {
                    $( value ).closest( '.form-group, .checkbox' ).removeClass( 'has-error' );
                }

            } else {
                $( value ).closest( '.form-group, .checkbox' ).removeClass( 'has-error' );
            }
        } );

        if ( isError ) return;

        // отправка на сервер
        $.ajax( {
            url: action,
            type: method,
            data: {
                'data': data,
                'formId': formId
            },
            dataType: 'json',

            success: function ( data ) {
                if ( data.result === 'success' ) {
                    var controls = form.find( '.form-control' );
                    $.each( controls, function ( index, value ) {
                        value.value = '';
                    } );

                    var message = form.find( '.message' );
                    message.append( data.message );
                    message.slideDown( 500 );

                    setTimeout( function () {
                        message.slideUp( 500, function () {
                            message.text( '' );
                        } )
                    }, 3000 );

                    app.ym.sendById( formId );

                } else if ( data.result === 'error' ) {
                    console.log( 'error', data );
                }
            }
        } );
    } );

    // сброс формы
    $( '.js-form .js-reset' ).on( 'click', function ( e ) {
        var formControls = $( this ).closest( '.js-form' ).find( '.js-required' );
        $.each( formControls, function ( index, value ) {
            $( value ).closest( '.form-group, .checkbox' ).removeClass( 'has-error' );
        } );
    } );

    // автофокус на поле формы
    $( '#modal-callback, #modal-discount, #modal-price' ).on( 'shown.bs.modal', function () {
        $( this ).find( '[autofocus]' ).focus();
    } );
};

/**
 * Работа мобильного меню
 */
app.mobileMenu = function() {
    $( '#menu-mobile' ).find( 'a.js-submenu-link' ).on( 'click', function ( e ) {
        e.preventDefault();

        var subMenu = $( this ).parent().find( 'ul.js-submenu' );

        subMenu.animate( {
            height: (subMenu.hasClass( 'js-menu-show' ) ? 'hide' : 'show')
        }, 300 );

        subMenu.toggleClass( 'js-menu-show' );
    } );
};

/**
 * Обработка скрола
 */
app.scroll = function() {
    var header = $( '#header' ), // шапка
        sidebar = $( '#sidebar-left' ), // левое меню
        awards = $( '#awards' ), // первая секция, которая пересекается с левым меню
        gotoTop = $( '#go-to-top' ), // кнопка срола страницы наверх

        scrollSizeStartHeader = 200, // размер скрола при котором фиксируется шапка
        scrollSizeStopHeader = 87; // когда убирать фикс шапки

    $( window ).on( 'scroll', function () {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop, // размер скрола
            menuLeftBrowserTop = sidebar.offset().top - scrollTop; // расстояние левого меню до верхнего края браузера

        // фиксируем топ меню
        if ( scrollTop > scrollSizeStartHeader ) {
            header.addClass( 'header--fixed' );
            gotoTop.addClass( 'go-to-top--show' )
        } else if ( scrollTop < scrollSizeStopHeader ) {
            header.removeClass( 'header--fixed' );
            gotoTop.removeClass( 'go-to-top--show' );
        }

        // фиксируем левое меню
        if ( menuLeftBrowserTop < 130 ) { // фиксируем
            sidebar.addClass( 'menu-left--fixed-top' );
        } else if ( scrollTop < 206 ) { // делаем как обычно
            sidebar.removeClass( 'menu-left--fixed-top' );
        } else { // перекрытие меню нижней секцией
            var awardsSectionBrowserTop = awards.offset().top - scrollTop, // расстояние секции до верхнего края браузера
                menuLeftOffsetY = 40;

            if ( awardsSectionBrowserTop < menuLeftBrowserTop + sidebar.height() + menuLeftOffsetY ) {
                sidebar.addClass( 'menu-left--fixed-bottom' );
            } else {
                sidebar.removeClass( 'menu-left--fixed-bottom' );
            }
        }

        return false;
    } );

    // кнопка наверх
    gotoTop.on( 'click', function () {
        $( 'body,html' ).animate( {
            scrollTop: 0
        }, 400 );
        return false;
    } );
};

/**
 * Работа "гамбургера" мобильного меню
 */
app.hamburger = function() {
    $( ".hamburger" ).on( 'click', function () {
        var self = this;
        $( self ).toggleClass( 'is-active' );
        setTimeout( function () {
            $( self ).toggleClass( 'is-active' );
        }, 1000 );

        $( '#sidebar' ).toggleClass( 'sidebar--show' );
    } );
};

/**
 * Слайдер наград
 */
app.sliderAwards = function() {
    $( '.js-slider-awards' ).slick( {
        dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 4,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }
        ]
    } );
};

/**
 * Слайдер сертификатов
 */
app.sliderCertificates = function() {
    $( '.js-slider-certificates' ).slick( {
        dots: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        autoplaySpeed: 2000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    arrows: false
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false
                }
            }
        ]
    } );
};

/**
 * Скрол при нажатии на якорь
 */
app.anchor = function() {
    $( 'a[href*="#"]:not([href="#"]):not(.carousel-control)' ).on( 'click', function () {
        if ( location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' )
            && location.hostname === this.hostname ) {

            var target = $( this.hash );
            target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );

            if ( target.length ) {
                var offset = 120;

                $( 'html, body' ).animate( {
                    scrollTop: target.offset().top - offset
                }, 400 );
                return false;
            }
        }
    } );
};

/**
 * Инициализация приложения
 */
$( function () {
    app.init();
} );
