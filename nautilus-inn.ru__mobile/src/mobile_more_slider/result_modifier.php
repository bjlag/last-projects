<?php
if ( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

if ( isset( $arParams[ 'EXCLUDE_ID' ] ) && !empty( $arParams[ 'EXCLUDE_ID' ] ) ) {
    foreach ( $arResult[ 'ITEMS' ] as $key => $arItem ) {
        if ( $arItem[ 'ID' ] == $arParams[ 'EXCLUDE_ID' ] ) {
            unset( $arResult[ 'ITEMS' ][ $key ] );
        }
    }
}
