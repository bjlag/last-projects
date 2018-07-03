<?php

namespace Nautilus\Classes\Helpers;

require_once $_SERVER[ 'DOCUMENT_ROOT' ] . '/local/php_interface/classes/lib/Mobile_Detect.php';

class MobileDetected extends \Mobile_Detect
{
    private static $instance = null;

    public static function getInstance()
    {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Перегружен метод родителя.
     * Добавлена работа с куками.
     *
     * @param null $userAgent
     * @param null $httpHeaders
     * @return bool - TRUE если мобильное устройство, FALSE иначе
     */
    public function isMobile( $userAgent = null, $httpHeaders = null )
    {
        if ( isset( $_COOKIE[ 'mobile' ] ) ) {
            if ( $_COOKIE[ 'mobile' ] == 'Y' ) {
                setcookie( 'mobile', 'Y', time() + 3600 * 24, '/' );
                return true;
            }
            setcookie( 'mobile', 'N', time() + 3600 * 24, '/' );
            return false;
        }

        if ( parent::isMobile( $userAgent, $httpHeaders ) ) {
            setcookie( 'mobile', 'Y', time() + 3600 * 24, '/' );
            return true;
        }

        setcookie( 'mobile', 'N', time() + 3600 * 24, '/' );
        return false;
    }
}
