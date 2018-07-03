;(function () {
    'use strict';

    /**
     * Калькулятор скидки
     * Начиная со второго по четвертый патент (любой) скидка 500 руб с каждого,
     * с пятого патента и далее скидка 1000 руб с каждого
     *
     * @constructor
     */
    var Calculator = function () {
        this.newPatent = {
            inputSelectorId: '#calc__new-patent-count',
            inputSelector: 'calc__new-patent-count',
            price: 25500
        };

        this.oldPatent = {
            inputSelectorId: '#calc__old-patent-count',
            inputSelector: 'calc__old-patent-count',
            price: 22990
        };

        this.selectorSubtotal = '#calc__subtotal';
        this.selectorDiscount = '#calc__discount';
        this.selectorTotal = '#calc__total';

        var discount1 = 500,
            discount2 = 1000,
            totalNew = 0,
            totalOld = 0,
            countNew = 0,
            countOld = 0;

        var getCountTotal = function () {
            return countNew + countOld;
        };

        this.isValidValue = function ( value ) {
            if ( !(/^\d+$/).test( value ) ) return false;
            return value > 0;
        };

        this.setTotalNew = function ( count ) {
            countNew = count;
            totalNew = count * this.newPatent.price;
        };

        this.setTotalOld = function ( count ) {
            countOld = count;
            totalOld = count * this.oldPatent.price;
        };

        this.getInputSelectors = function () {
            return this.newPatent.inputSelectorId + ',' + this.oldPatent.inputSelectorId;
        };

        this.getSubtotal = function () {
            return totalNew + totalOld;
        };

        this.getDiscountTotal = function () {
            var countTotal = getCountTotal();

            if ( countTotal <= 4 ) {
                return countTotal > 1 ? countTotal * discount1 : 0;
            } else {
                // return ( 4 * this.discount1 )
                //     + ( ( countTotal - 4 ) * this.discount2 ); //  оставил на будущее
                return countTotal * discount2;
            }
        };
    };

    $( document ).ready( function () {
        var calc = new Calculator();

        $( calc.getInputSelectors() ).on( 'keyup', function () {
            var count = parseInt( this.value );

            if ( !calc.isValidValue( this.value ) ) {
                this.value = '';
                count = 0;
            }

            switch ( this.id ) {
                case calc.newPatent.inputSelector:
                    calc.setTotalNew( count );
                    break;
                case calc.oldPatent.inputSelector:
                    calc.setTotalOld( count );
                    break;
                default:
                    return false;
            }

            var subtotal = calc.getSubtotal(),
                discountTotal = calc.getDiscountTotal();

            $( calc.selectorSubtotal )[ 0 ].value = subtotal;
            $( calc.selectorDiscount )[ 0 ].value = discountTotal;
            $( calc.selectorTotal )[ 0 ].value = subtotal - discountTotal;
        } );
    } );
})();