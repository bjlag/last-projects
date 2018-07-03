<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once( 'phpmailer/PHPMailer.php' );

$ID_FORM_CALL_BACK = 'form__callback';
$ID_FORM_ORDER = 'form__order';
$ID_FORM_SALE = 'form__sale';
$ID_FORM_CONSULTATION = 'form__consultation';

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST'
    && !empty( $_POST[ 'data' ] )
    && !empty( $_POST[ 'formId' ] ) ) {

    $mail = new PHPMailer();

    $fromEmail = 'info@info.ru';
    $fromName = 'Капитал Кадры';
    $toEmail = 'info@info.ru';
    $toName = 'Капитал Кадры';

    $subject = 'Заполнена форма на сайте';
    $body = '';
    $messageSuccess = 'Ваша заявка отправлена. Спасибо!';
    $messageError = 'Не удалось отправить сообщение!';

    $data = array();
    parse_str( $_POST[ 'data' ], $data );

    if ( $_POST[ 'formId' ] === $ID_FORM_CALL_BACK ) {
        $subject = 'Заказан обратный звонок';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $referrer";

    } elseif ( $_POST[ 'formId' ] === $ID_FORM_ORDER ) {
        $subject = 'Новая заявка';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $email = isset( $data[ 'email' ] ) ? 'Email: ' . $data[ 'email' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $email $referrer";

    } elseif ( $_POST[ 'formId' ] === $ID_FORM_SALE ) {
        $subject = 'Заявка на скидку';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $email = isset( $data[ 'email' ] ) ? 'Email: ' . $data[ 'email' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $email $referrer";

    } elseif ( $_POST[ 'formId' ] === $ID_FORM_CONSULTATION ) {
        $subject = 'Заказана консультация';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $message = isset( $data[ 'message' ] ) ? 'Сообщение:<br>' . $data[ 'message' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $message $referrer";
    }

    $mail->setFrom( $fromEmail, $fromName );
    $mail->addAddress( $toEmail, $toName );

    $mail->isHTML( true );
    $mail->CharSet = 'utf-8';
    $mail->Subject = $subject;
    $mail->Body = $body;

    $sendEmail = $mail->Send();

    if ( $sendEmail == true ) {
        echo '{ "result": "success", "message": "' . $messageSuccess . '" }';
    } else {
        echo '{ "result": "error", "message": "' . $messageError . '" }';
    }
} else {
    echo '{ "result": "error" }';
}