<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once( 'phpmailer/PHPMailer.php' );

define( 'ID_FORM_CALL_BACK', 'form-modal-callback' );
define( 'ID_FORM_PRICE', 'form-modal-price' );
define( 'ID_FORM_DISCOUNT', 'form-modal-discount' );
define( 'ID_FORM_FEEDBACK', 'form-feedback' );

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST'
    && !empty( $_POST[ 'data' ] )
    && !empty( $_POST[ 'formId' ] ) ) {

    $mail = new PHPMailer();

    $recipients = [
        'donniva@mail.ru' => 'Донская Нива'
    ];

    $fromEmail = 'office@petromaslo.ru';
    $fromName = 'Донская Нива';

    $subject = 'Заполнена форма на сайте';
    $body = '';

    $messageSuccess = 'Ваша заявка отправлена. Спасибо!';
    $messageError = 'Не удалось отправить сообщение!';

    $data = array();
    parse_str( $_POST[ 'data' ], $data );

    if ( $_POST[ 'formId' ] === ID_FORM_CALL_BACK ) {
        $subject = 'Заказан обратный звонок';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $referrer";

    } elseif ( $_POST[ 'formId' ] === ID_FORM_PRICE ) {
        $subject = 'Запрос прайса';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $email = isset( $data[ 'email' ] ) ? 'Email: ' . $data[ 'email' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $email $referrer";

    } elseif ( $_POST[ 'formId' ] === ID_FORM_DISCOUNT ) {
        $subject = 'Заявка на скидку от объема';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $email = isset( $data[ 'email' ] ) ? 'Email: ' . $data[ 'email' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $email $referrer";

    } elseif ( $_POST[ 'formId' ] === ID_FORM_FEEDBACK ) {
        $subject = 'Сообщение с сайта';
        $name = isset( $data[ 'name' ] ) ? 'Имя: ' . $data[ 'name' ] . '<br>' : '';
        $phone = isset( $data[ 'phone' ] ) ? 'Телефон: ' . $data[ 'phone' ] . '<br>' : '';
        $email = isset( $data[ 'email' ] ) ? 'Email: ' . $data[ 'email' ] . '<br>' : '';
        $message = isset( $data[ 'message' ] ) ? 'Сообщение:<br>' . $data[ 'message' ] . '<br>' : '';
        $referrer = $_SERVER[ 'HTTP_REFERER' ]
            ? '--<br>Форма была заполнена по адресу: ' . $_SERVER[ 'HTTP_REFERER' ]
            : '';

        $body = "$name $phone $email $message $referrer";
    }

    $mail->setFrom( $fromEmail, $fromName );

    foreach ( $recipients as $email => $name ) {
        $mail->addAddress( $email, $name );
    }

    $mail->isMail();
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