                </div>
            </main>
        </div>
    </div>

    <?php
    // слайдер спецпредложений на всех страницах, кроме главной
    if ( !$isMainPage && !$hideOffers ) {
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
                "SORT_ORDER2" => "DESC",
                "BACKGROUND_SHOW" => "Y",
                "ALWAYS_SHOW" => "Y"
            )
        );
    } ?>

    <section class="how-to-get">
        <div class="container">
            <div class="section-title">
                <?= GetMessage( 'HOW_TO_GET_TITLE' ) ?>
                <span>
                    <i class="fa fa-home fa__map" aria-hidden="true"></i> <?= GetMessage( 'HOW_TO_GET_ADDRESS' ) ?>
                </span>
            </div>
            <div class="map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A5c1231a823435daa147049231f229fd6f732fdcbf40c236715f048d4a916cf35&amp;width=100%25&amp;height=300&amp;lang=<?= LANGUAGE_ID ?>&amp;scroll=false" data-skip-moving="true"></script>
            </div>
            <div class="how-to-get__button">
                <a class="button" href="<?= SITE_DIR ?>kontakty/ot-moskovskogo-vokzala/"><?= GetMessage( 'HOW_TO_GET_FROM_1' ) ?></a>
                <a class="button" href="<?= SITE_DIR ?>kontakty/ot-ladozhskogo-vokzala/"><?= GetMessage( 'HOW_TO_GET_FROM_2' ) ?></a>
                <a class="button" href="<?= SITE_DIR ?>kontakty/ot-pulkovo/"><?= GetMessage( 'HOW_TO_GET_FROM_3' ) ?></a>
                <a class="button" href="<?= SITE_DIR ?>kontakty/na-transporte-ot-stantsii-metro/"><?= GetMessage( 'HOW_TO_GET_FROM_4' ) ?></a>
            </div>
        </div>
    </section>
    <section class="advantages">
        <div class="container">

            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "PATH" => SITE_DIR . "include/advantage_mobile.php",
                    "EDIT_TEMPLATE" => ""
                ),
                false
            ); ?>

        </div>
    </section>
    <?php
    // слайдер отзывов
    $APPLICATION->IncludeComponent(
        "bitrix:news.line",
        "mobile_reviews_slider",
        Array(
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "2592000",
            "CACHE_TYPE" => "A",
            "COMPONENT_TEMPLATE" => "mobile_reviews_slider",
            "DETAIL_URL" => "",
            "FIELD_CODE" => array(
                0 => "PREVIEW_TEXT"
            ),
            "IBLOCKS" => array(
                0 =>  ( LANGUAGE_ID == 'ru' ? '14' : '25' )
            ),
            "IBLOCK_TYPE" =>  ( LANGUAGE_ID == 'ru' ? 'content' : 'content_en' ),
            "NEWS_COUNT" => "20",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC"
        )
    ); ?>
    <div class="menu-bottom">
        <!--todo: menu bottom-->
    </div>
    <footer class="footer">
        <div class="container">
            <div class="footer__payment-methods">
                <div class="payment-methods">
                    <div class="payment-methods__title">
                        <?= GetMessage( 'PAYMENT_METHODS_TITLE' ) ?>
                    </div>
                    <div class="payment-methods__body">
                        <ul class="payment-methods__list">
                            <li class="payment-methods__list-item">
                                <img class="payment-methods__img" src="<?= SITE_TEMPLATE_PATH ?>/images/pm_visa.jpg" alt="Visa">
                            </li>
                            <li class="payment-methods__list-item">
                                <img class="payment-methods__img" src="<?= SITE_TEMPLATE_PATH ?>/images/pm_mastercard.jpg" alt="MasterCard">
                            </li>
                            <li class="payment-methods__list-item">
                                <img class="payment-methods__img" src="<?= SITE_TEMPLATE_PATH ?>/images/pm_webmoney.jpg" alt="Webmoney">
                            </li>
                            <li class="payment-methods__list-item">
                                <img class="payment-methods__img" src="<?= SITE_TEMPLATE_PATH ?>/images/pm_paypal.jpg" alt="PayPal">
                            </li>
                            <li class="payment-methods__list-item">
                                <img class="payment-methods__img" src="<?= SITE_TEMPLATE_PATH ?>/images/pm_qiwi.jpg" alt="QIWI">
                            </li>
                            <li class="payment-methods__list-item">
                                <img class="payment-methods__img" src="<?= SITE_TEMPLATE_PATH ?>/images/pm_yandex_money.jpg" alt="Яндекс Деньги">
                            </li>
                        </ul>
                        <a href="<?= SITE_DIR ?>bronirovanie/sposoby-oplaty/" class="payment-methods__link"><?= GetMessage( 'PAYMENT_METHODS_ALL' ) ?></a>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__copyright">
                    2003&ndash;<?= date( 'Y' ) ?> <?= GetMessage( 'FOOTER_COPYRIGHT' ) ?>
                </div>
                <div class="footer__address">
                    <?= GetMessage( 'FOOTER_ADDRESS' ) ?>
                </div>
                <div class="footer__developer">
                    <a href="https://webstride.ru/" target="_blank"><?= GetMessage( 'FOOTER_DEVELOPER' ) ?></a>
                </div>
            </div>
        </div>
    </footer>
</div>

<?php
$APPLICATION->AddHeadScript( SITE_TEMPLATE_PATH . '/js/vendor.js' );
$APPLICATION->AddHeadScript( SITE_TEMPLATE_PATH . '/js/main.js' ); ?>

<?php
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "/include/count.php",
        "EDIT_TEMPLATE" => ""
    ),
    false
);?>

</body>

</html>