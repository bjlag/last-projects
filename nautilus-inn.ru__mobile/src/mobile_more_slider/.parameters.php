<?php
if ( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

$arTemplateParameters = array(
    "BACKGROUND_SHOW" => Array(
        "NAME" => GetMessage( "M_SPECIALS_BACKGROUND_SHOW" ),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
    ),
    "ALWAYS_SHOW" => Array(
        "NAME" => GetMessage( "M_SPECIALS_ALWAYS_SHOW" ),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
    ),
    "EXCLUDE_ID" => Array(
        "NAME" => GetMessage( "M_SPECIALS_EXCLUDE_ID" ),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
    ),
    "TITLE" => Array(
        "NAME" => GetMessage( "M_SPECIALS_TITLE" ),
        "TYPE" => "STRING",
        "DEFAULT" => "N",
    ),
);
