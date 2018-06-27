<?php
defined( '_JEXEC' ) or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();

// убираем подключение скриптов
$this->_scripts = array();
unset( $this->_script[ 'text/javascript' ] );

// запоминаем URL к шаблону
$template_url = $this->baseurl . '/templates/' . $this->template;

// подключаем CSS и JS
$doc->addStyleSheet( $template_url . '/css/vendor.min.css' );
$doc->addStyleSheet( $template_url . '/css/template.min.css' );

$doc->addScript( $template_url . '/js/vendor.min.js' );

// проверка, является ли открытая страница главной
$is_home_page = ( $menu->getActive() == $menu->getDefault( $lang->getTag() ) );

// выводить или нет блоки во пределенных позициях
$show_message = ( $this->countModules( 'message' ) ? true : false );
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <jdoc:include type="head"/>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
    <meta name="format-detection" content="telephone=no">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// --><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body class="body body--bg">

<div class="wrapper">

    <!--header-->
    <header id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 header__logo">
                    <div class="logo">
                        <a class="logo__link" href="/">
                            <img class="logo__img" src="<?= $template_url ?>/images/logo.png" alt="Донская Нива"> </a>
                        <div class="logo__description hidden-xs">
                            Завод<br>
                            Донская Нива
                        </div>
                    </div>
                </div>
                <nav class="col-md-7 col-lg-5 hidden-xs hidden-sm header__menu">
                    <jdoc:include type="modules" name="menu-top"/>
                </nav>
                <div class="col-md-2 col-lg-4 hidden-xs hidden-sm header__phone">
                    <div class="phones-in-header">
                        <div class="phones-in-header__row clearfix">
                            <div class="phones-in-header__left-side">
                                <div class="phones-in-header__title">
                                    Завод «Донская Нива»
                                </div>
                            </div>
                            <div class="phones-in-header__right-side">
                                <div class="phones-in-header__phone">
                                    <a href="tel:+74747738464">+7 (47477) 380-52</a>
                                </div>
                            </div>
                        </div>

                        <div class="phones-in-header__row clearfix">
                            <div class="phones-in-header__left-side">
                                <div class="phones-in-header__title">
                                    Дистрибьютер в СПб
                                </div>
                            </div>
                            <div class="phones-in-header__right-side">
                                <div class="phones-in-header__phone">
                                    <a href="tel:+78124485255">+7 (812) 448-5255</a>
                                </div>
                            </div>
                        </div>

                        <div class="phones-in-header__callback">
                            <a href="#" class="phones-in-header__callback-link" data-toggle="modal"
                               data-target="#modal-callback" data-ym="FORM_CALLBACK_OPEN">Заказать звонок</a>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 col-sm-6 visible-xs-block visible-sm-block header__hamburger">
                    <button id="hamburger" class="hamburger hamburger--arrowalt" type="button">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>

            </div>
        </div>
    </header>
    <!--end header-->

    <!--poster-->
    <div class="poster">
        <div class="container">
            <div class="poster__wrapper">
                <img class="poster__inner-img hidden-xs hidden-sm" src="<?= $template_url ?>/images/flower.png" alt="Цветок подсолнуха">
                <div class="poster__description">
                    Производство и оптовая продажа<br class="hidden-xs">
                    подсолнечного масла
                </div>
            </div>
            <div class="poster__overlay"></div>
        </div>
    </div>
    <!--end poster-->

    <!--bread-crumbs-->
    <div class="poster-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-md-offset-3">
                    <jdoc:include type="modules" name="bread-crumbs"/>
                </div>
            </div>
        </div>
    </div>
    <!--end bread-crumbs-->

    <!--content-->
    <div class="container margin-bottom-normal" style="position: relative /*нужно для фиксации левого меню*/">
        <div class="row">
            <div class="col-md-3" style="position: static /*нужно для фиксации левого меню*/">
                <div id="sidebar-left">
                    <nav class="hidden-xs hidden-sm">
                        <jdoc:include type="modules" name="menu-left"/>
                    </nav>

                    <?php
                    if ( $show_message ): ?>
                        <aside>
                            <jdoc:include type="modules" name="message"/>
                        </aside>
                    <?php
                    endif; ?>
                </div>
            </div>
            <div class="col-md-9">
                <main class="main">
                    <jdoc:include type="component"/>
                    <jdoc:include type="modules" name="content"/>
                </main>
            </div>
        </div>
    </div>
    <!--end content-->

    <!--awards-->
    <section id="awards" class="section section--fill margin-top-large">
        <div class="section__title">
            <h2>Наши награды и сертификаты</h2>
        </div>
        <div class="container">

            <jdoc:include type="modules" name="widget-awards"/>

        </div>
    </section>
    <!--end awards-->

    <!--news-->
    <section class="section">
        <div class="section__title">
            <h2>Новости отрасли</h2>
        </div>
        <div class="container">

            <jdoc:include type="modules" name="widget-news"/>

            <div class="text-center margin-top-normal">
                <a class="btn btn__go" href="/o-zavode/novosti-otrasli/">Все новости</a>
            </div>
        </div>
    </section>
    <!--end news-->

</div>

<!--footer-->
<footer class="footer">
    <div class="footer__top">
        <div class="container">
            <div class="row">
                <div class="col-md-3 hidden-xs hidden-sm">
                    <a class="logo" href="/">
                        <img class="logo__img" src="<?= $template_url ?>/images/logo.png" alt="Донская Нива"> </a>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="contacts-block">
                                <div class="contacts-block__title">
                                    Завод «Донская Нива»
                                </div>
                                <div class="contacts-block__address">
                                    399250, Липецкая обл., Хлевенский р-н,<br> с. Дмитряшевка, ул. Механизаторов, д. 11
                                </div>
                                <div class="row">
                                    <div class="col-md-5 contacts-block__phones">
                                        +7 (47477) 380-50<br> +7 (47477) 380-51<br> +7 (47477) 380-52
                                    </div>
                                    <div class="col-md-5 contacts-block__email">
                                        <a href="mailto:donniva@mail.ru">donniva@mail.ru</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contacts-block">
                                <div class="contacts-block__title">
                                    Дистрибьютер в Санкт-Петербурге
                                </div>
                                <div class="contacts-block__address">
                                    192102, г. Санкт-Петербург,<br> ул. Салова, д. 45
                                </div>
                                <div class="row">
                                    <div class="col-md-5 contacts-block__phones">
                                        +7 (812) 448-5255<br> +7 (812) 448-5257<br> +7 (812) 448-5258
                                    </div>
                                    <div class="col-md-5 contacts-block__email">
                                        <a href="mailto:office@petromaslo.ru">office@petromaslo.ru</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 footer__bottom-copyright">
                    &copy; <?= date( 'Y' ) ?>. Завод «Донская Нива»
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 footer__bottom-developer">
                    <a class="link-developer" target="_blank" href="https://webstride.ru">Интернет-агентство
                        «ВебСтрайд»</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--end footer-->

<!--mobile navigation-->
<div id="sidebar" class="sidebar">
    <div class="sidebar__container">
        <div class="sidebar__header">
            <button id="hamburger-sidebar" class="hamburger hamburger--arrowalt-r is-active" type="button">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
        <div class="sidebar__body">
            <div class="sidebar__inner-body">
                <nav>
                    <jdoc:include type="modules" name="menu-mobile-top"/>
                    <hr class="sidebar__separator">
                    <jdoc:include type="modules" name="menu-mobile-left"/>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--end mobile navigation-->

<!--go to top-->
<div id="go-to-top" class="go-to-top hidden-xs hidden-sm">
    <a href="" class="go-to-top__btn"> <i class="fa fa-chevron-up" aria-hidden="true"></i> </a>
</div>
<!--end go to top-->

<!-- Forms -->
<div class="modal fade" id="modal-callback" tabindex="-1" role="dialog" aria-labelledby="modal-callback">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Заказать обратный звонок</h4>
            </div>
            <form id="form-modal-callback" class="js-form" method="post" action="<?= "$template_url/include/send_form.php" ?>">
                <div class="modal-body">
                    <div class="message"></div>

                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-callback-name" name="name"
                               placeholder="Ваше имя" autofocus> <span class="form-group__required">*</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-callback-phone" name="phone"
                               placeholder="Номер телефона"> <span class="form-group__required">*</span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="js-required" id="form-modal-callback-agreement" name="agreement" checked>
                            Я согласен на <a href="/soglasie-na-obrabotku-personalnykh-dannykh/">обработку персональных
                                данных</a> </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn__action btn--small js-submit">Заказать</button>
                    <button type="reset" class="btn btn--reset btn--small js-reset">Сбросить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-price" tabindex="-1" role="dialog" aria-labelledby="modal-price">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Запросить оптовый прайс</h4>
            </div>
            <form id="form-modal-price" class="js-form" method="post" action="<?= "$template_url/include/send_form.php" ?>">
                <div class="modal-body">
                    <div class="message"></div>

                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-price-name" name="name"
                               placeholder="Ваше имя" autofocus> <span class="form-group__required">*</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-price-phone" name="phone"
                               placeholder="Номер телефона"> <span class="form-group__required">*</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-price-email" name="email"
                               placeholder="Электронная почта"> <span class="form-group__required">*</span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="js-required" id="form-modal-price-agreement" name="agreement" checked>
                            Я согласен на <a href="/soglasie-na-obrabotku-personalnykh-dannykh/">обработку персональных
                                данных</a> </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn__action btn--small js-submit">Запросить</button>
                    <button type="reset" class="btn btn--reset btn--small js-reset">Сбросить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-discount" tabindex="-1" role="dialog" aria-labelledby="modal-discount">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Заявка на получение скидки</h4>
            </div>
            <form id="form-modal-discount" class="js-form" method="post" action="<?= "$template_url/include/send_form.php" ?>">
                <div class="modal-body">
                    <div class="message"></div>

                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-discount-name" name="name"
                               placeholder="Ваше имя" autofocus> <span class="form-group__required">*</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-discount-phone" name="phone"
                               placeholder="Номер телефона"> <span class="form-group__required">*</span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control js-required" id="form-modal-discount-email" name="email"
                               placeholder="Электронная почта"> <span class="form-group__required">*</span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" class="js-required" id="form-modal-discount-agreement" name="agreement" checked>
                            Я согласен на <a href="/soglasie-na-obrabotku-personalnykh-dannykh/">обработку персональных
                                данных</a> </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn__action btn--small js-submit">Отправить</button>
                    <button type="reset" class="btn btn--reset btn--small js-reset">Сбросить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= $template_url ?>/js/main.min.js"></script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter16960375 = new Ya.Metrika2({
                    id:16960375,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/16960375" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<jdoc:include type="modules" name="debug"/>
</body>
</html>