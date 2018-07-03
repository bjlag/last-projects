<?php
if ( !defined("B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

IncludeTemplateLangFile(__FILE__);

$isMainPage = $APPLICATION->GetCurPage( false ) == SITE_DIR;
$showMenuLeft = $APPLICATION->GetDirProperty( 'menu_left_show' ) == 'Y';
$hideOffers = $APPLICATION->GetDirProperty( 'offers_hide' ) == 'Y';
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <title><? $APPLICATION->ShowTitle() ?></title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <? $APPLICATION->ShowHead() ?>
    <? $APPLICATION->SetAdditionalCSS( SITE_TEMPLATE_PATH . '/css/vendor.css' ) ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js" data-skip-moving="true"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" data-skip-moving="true"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon-16x16.png">
    <link rel="shortcut icon" href="<?= SITE_TEMPLATE_PATH ?>/images/favicons/favicon.ico">

    <!-- WuBook -->
    <script src="https://wubook.net/js/wbbook.jgz" data-skip-moving="true"></script>
    <script data-skip-moving="true">var WuBook= new _WuBook(1328168356);</script>
</head>

<body>

<? $APPLICATION->ShowPanel(); ?>

<div class="wrapper">
    <header class="header">
        <div class="header__lang">
            <div class="container clearfix">
                <ul class="lang">
                    <li class="lang__item">
                        <a class="lang__link <?= ( LANGUAGE_ID == 'ru' ? 'lang__link--active' : '' ) ?>" href="/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_ru.jpg" alt="Русский">
                        </a>
                    </li>
                    <li class="lang__item">
                        <a class="lang__link <?= ( LANGUAGE_ID == 'en' ? 'lang__link--active' : '' ) ?>" href="/en/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_en.jpg" alt="Английский">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="header__contacts">
            <div class="container header__contacts-inner clearfix">
                <div class="header__left">
                    <div class="header__phone">
                        <a href="tel:88007001807" rel="nofollow">
                            <span>8 800</span> 700-18-07
                        </a>
                    </div>
                    <div class="header__phone-title">
                        <?= GetMessage( 'PHONE_8800_DESCRIPTION' ) ?>
                    </div>
                </div>
                <div class="header__right">
                    <div class="header__phone">
                        <a href="tel:+78124499000" rel="nofollow">
                            <span>+7 (812)</span> 449-90-00
                        </a>
                    </div>
                    <div class="header__phone-title">
                        <?= GetMessage( 'PHONE_8812_DESCRIPTION' ) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header__logo">
            <div class="container">
                <div class="logo">
                    <a class="logo__link" href="<?= SITE_DIR ?>">
                        <img class="logo__img" src="<?= SITE_TEMPLATE_PATH ?>/images/logo.png" alt="Отель Наутилус-Inn">
                    </a>
                    <div class="logo__title">
                        <?= GetMessage( 'LOGO_DESCRIPTION' ) ?>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <div class="nav-top">
        <div class="container">
            <div class="nav-top__icons">
                <ul class="icons-list">
                    <li class="icons-list__item">
                        <a href="<?= SITE_DIR ?>uslugi/besplatnyy-wifi/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_wifi.png" alt="<?= GetMessage( 'HEADER_ICO_FREE_WIFI' ) ?>">
                        </a>
                    </li>
                    <li class="icons-list__item">
                        <a href="<?= SITE_DIR ?>uslugi/okhranyaemaya-parkovka/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_parking.png" alt="<?= GetMessage( 'HEADER_ICO_PARKING' ) ?>">
                        </a>
                    </li>
                    <li class="icons-list__item">
                        <a href="<?= SITE_DIR ?>restoran/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_restaurant.png" alt="<?= GetMessage( 'HEADER_ICO_RESTAURANT' ) ?>">
                        </a>
                    </li>
                    <li class="icons-list__item hidden-xs">
                        <a href="<?= SITE_DIR ?>konferents-zaly/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_hall.png" alt="<?= GetMessage( 'HEADER_ICO_MEETING_ROOMS' ) ?>">
                        </a>
                    </li>
                    <li class="icons-list__item hidden-xs">
                        <a href="<?= SITE_DIR ?>spetspredlozheniya/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_offers.png" alt="<?= GetMessage( 'HEADER_ICO_SPECIAL_OFFERS' ) ?>">
                        </a>
                    </li>
                    <li class="icons-list__item hidden-xs">
                        <a href="<?= SITE_DIR ?>nomera/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_rooms.png" alt="<?= GetMessage( 'HEADER_ICO_ROOMS_RATES' ) ?>">
                        </a>
                    </li>
                    <li class="icons-list__item hidden-xs hidden-md">
                        <a href="<?= SITE_DIR ?>uslugi/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_service.png" alt="<?= GetMessage( 'HEADER_ICO_SERVICES' ) ?>">
                        </a>
                    </li>
                    <li class="icons-list__item hidden-xs hidden-md">
                        <a href="<?= SITE_DIR ?>ob-otele/fotogalereya/">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_photo.png" alt="<?= GetMessage( 'HEADER_ICO_PHOTOS' ) ?>">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="menu-wrapper clearfix">
                <a href="<?= SITE_DIR ?>bronirovanie/" class="button-booking">
                    <?= GetMessage( 'BUTTON_BOOKING' ) ?> <img src="<?= SITE_TEMPLATE_PATH ?>/images/i_bell.png" alt="<?= GetMessage( 'BUTTON_BOOKING' ) ?>">
                </a>
                <a href="#" class="menu-trigger js__menu-trigger">
                    <span><?= GetMessage( 'MENU_TRIGGER_TITLE' ) ?></span>
                    <i class="hamburger hamburger--slider">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </i>
                </a>
                <?php
                // меню top
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "mobile_top",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "COMPONENT_TEMPLATE" => "mobile_top",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "2",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MENU_CACHE_TIME" => "2592000",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "mobile_top",
                        "USE_EXT" => "N"
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>

    <?php
    // слайдер спецпредложений на главной странице
    if ( $isMainPage ) {
        $APPLICATION->IncludeComponent(
            "bitrix:news.line",
            "mobile_special_slider",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "2592000",
                "CACHE_TYPE" => "A",
                "COMPONENT_TEMPLATE" => "mobile_special_slider",
                "DETAIL_URL" => "",
                "FIELD_CODE" => array(
                    0 => "PREVIEW_PICTURE",
                    1 => "DETAIL_PICTURE"
                ),
                "IBLOCKS" => array( 0 => ( LANGUAGE_ID == 'ru' ? '9' : '21' ) ),
                "IBLOCK_TYPE" => ( LANGUAGE_ID == 'ru' ? 'content' : 'content_en' ),
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "SORT",
                "SORT_BY2" => "TIMESTAMP_X",
                "SORT_ORDER1" => "ASC",
                "SORT_ORDER2" => "DESC"
            )
        );
    } ?>


    <div class="content clearfix">

        <?php
        if( $showMenuLeft ):?>

            <div class="content__widget">

                <?php
                // меню left
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "mobile_left",
                    Array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "COMPONENT_TEMPLATE" => "mobile_left",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "1",
                        "MENU_CACHE_GET_VARS" => "",
                        "MENU_CACHE_TIME" => "2592000",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "left",
                        "USE_EXT" => "N"
                    )
                ); ?>

            </div>

        <?php
        endif; ?>

        <div class="content__main <?= ( $isMainPage || !$showMenuLeft ? 'content--full' : '' ) ?>">
            <main class="main">
                <div class="main__header">
                    <h1><?= ( $isMainPage ? GetMessage( 'TITLE_MAIN_PAGE' ) : $APPLICATION->ShowTitle() ) ?></h1>
                </div>
                <div class="main__content">
                <?php
                if ( $isMainPage ) {
                    // слайдер номеров на главной странице
                    $APPLICATION->IncludeComponent(
                        "bitrix:news.line",
                        "mobile_rooms_slider",
                        array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "2592000",
                            "CACHE_TYPE" => "A",
                            "COMPONENT_TEMPLATE" => "mobile_rooms_slider",
                            "DETAIL_URL" => "",
                            "FIELD_CODE" => array(
                                0 => "PREVIEW_TEXT",
                                1 => "PREVIEW_PICTURE",
                                2 => "DETAIL_PICTURE",
                                3 => "",
                                4 => "",
                            ),
                            "IBLOCKS" => array(
                                0 => ( LANGUAGE_ID == 'ru' ? '5' : '17' )
                            ),
                            "IBLOCK_TYPE" => ( LANGUAGE_ID == 'ru' ? 'content' : 'content_en' ),
                            "NEWS_COUNT" => "20",
                            "SORT_BY1" => "SORT",
                            "SORT_BY2" => "TIMESTAMP_X",
                            "SORT_ORDER1" => "ASC",
                            "SORT_ORDER2" => "DESC"
                        ),
                        false
                    );
                } ?>
