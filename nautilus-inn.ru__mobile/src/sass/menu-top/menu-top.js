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
