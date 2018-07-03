;(function () {
    'use strict';

    // маски ввода
    $( '#form__callback-phone' ).mask( '+7 (999) 999-9999' );
    $( '#form__order-phone' ).mask( '+7 (999) 999-9999' );
    $( '#form__consultation-phone' ).mask( '+7 (999) 999-9999' );
    $( '#form__sale-phone' ).mask( '+7 (999) 999-9999' );

    // отправка заявок
    $( '.js-form' ).on( 'submit', function ( e ) {
        e.preventDefault();

        var form = $( this ),
            action = form.attr( 'action' ),
            method = form.attr( 'method' ),
            formId = form.attr( 'id' ),
            data = form.serialize(),
            required = form.find( '.js-required' ),
            yaEventSendId = form.attr( 'data-ya-event-send' ),
            isError = false;

        // валидация
        $.each( required, function ( index, value ) {
            if ( value.value.trim() === '' ) {
                $( value ).addClass( 'input-error' );
                isError = true;
            } else {
                $( value ).removeClass( 'input-error' );
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

                    var message = form.parent().find( '.message' );
                    message.append( data.message );
                    message.animate( {
                        opacity: 'show',
                        paddingTop: 20,
                        paddingBottom: 20
                    }, 1000 );

                    setTimeout( function () {
                        message.animate( {
                            opacity: 'hide',
                            paddingTop: 'hide',
                            paddingBottom: 'hide'
                        }, 1000, function () {
                            message.text( '' );
                        } );
                    }, 3000 );

                    ya.SendEvent( yaEventSendId );

                } else if ( data.result === 'error' ) {
                    console.log( 'error', data );
                }
            }
        } );
    } );
})();

