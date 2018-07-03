;(function () {
    'use strict';

    // скрол до якоря
    $( document ).ready( function () {
        $( 'a[href*="#"]:not([href="#"]):not(.carousel-control)' ).on( 'click', function () {
            if ( location.pathname.replace( /^\//, '' ) === this.pathname.replace( /^\//, '' )
                && location.hostname === this.hostname ) {

                var target = $( this.hash );
                target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );

                if ( target.length ) {
                    $( 'html, body' ).animate( {
                        scrollTop: target.offset().top
                    }, 400 );
                    return false;
                }
            }
        } );
    } );
})();