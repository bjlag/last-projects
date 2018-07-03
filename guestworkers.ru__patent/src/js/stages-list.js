;(function () {
    'use strict';

    $( document ).ready( function () {
        // как оформить патент
        var Stages = function () {
            this.list = $( '#stages__list' );

            var activeSelector = 'stages__list-item--active',
                currentItemId = this.list.find( '.' + activeSelector ).attr( 'data-stage' );

            this.isCurrentItem = function ( newItemID ) {
                return currentItemId === newItemID;
            };

            this.setNewCurrentItem = function ( newItemId ) {
                currentItemId = newItemId;
            };

            this.changeStage = function ( newItemId ) {
                var speed = 300,
                    currentItem = this.list.find( '.' + activeSelector ),
                    newItem = this.list.find( '[data-stage="' + newItemId + '"]' );

                currentItem.removeClass( activeSelector );
                newItem.addClass( activeSelector );

                $( '#' + currentItemId ).animate( { height: 'toggle' }, speed );
                $( '#' + newItemId ).animate( { height: 'toggle' }, speed );
            };

            $( '#' + currentItemId ).show();
        };

        var stages = new Stages();

        stages.list.find( 'li' ).on( 'click', function () {
            var newItemId = $( this ).attr( 'data-stage' );

            if ( stages.isCurrentItem( newItemId ) ) return;

            stages.changeStage( newItemId );
            stages.setNewCurrentItem( newItemId );
        } );
    } );
})();