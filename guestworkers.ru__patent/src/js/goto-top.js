;(function () {
    'use strict';

    var GotoTop = function ( options ) {
        var scrollSize = options.scrollSize,
            button = $( options.buttonId ),
            classShow = options.classShow;

        $( window ).on( 'scroll', function () {
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if ( scrollTop > scrollSize ) {
                button.addClass( classShow )
            } else {
                button.removeClass( classShow );
            }
        } );

        // кнопка наверх
        button.on( 'click', function () {
            $( 'body, html' ).animate( {
                scrollTop: 0
            }, 400 );
            return false;
        } );
    };

    $( document ).ready( function () {
        new GotoTop( {
            buttonId: '#goto-top',
            classShow: 'goto-top--show',
            scrollSize: 200
        } );
    } );
})();