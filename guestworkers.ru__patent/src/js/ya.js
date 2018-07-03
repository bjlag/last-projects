var ya = (function () {
    'use strict';

    $( window ).ready( function () {

        $( '.js-ya-click' ).on( 'click', function () {
            var yaEventId = $( this ).attr( 'data-ya-event-id' );
            if ( !yaEventId ) return false;

            yaCounter46819845.reachGoal( yaEventId );
        } );

    } );

    return {
        SendEvent: function ( eventId ) {
            if ( !eventId ) return;
            yaCounter46819845.reachGoal( eventId );
        }
    };
})();