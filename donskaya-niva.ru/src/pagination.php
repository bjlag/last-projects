<?php
function pagination_list_render( $list )
{
    $doc = JFactory::getDocument();

    $currentPage = 1;
    $range = 1;
    $step = 5;
    foreach ( $list[ 'pages' ] as $k => $page ) {
        if ( !$page[ 'active' ] ) {
            $currentPage = $k;
        }
    }

    if ( $currentPage >= $step ) {
        if ( $currentPage % $step == 0 ) {
            $range = ceil( $currentPage / $step ) + 1;
        } else {
            $range = ceil( $currentPage / $step );
        }
    }

    $html = '<ul class="pagination pagination-sm">';

    if ( $list[ 'previous' ]['active'] ) {
        $html .= '<li class="pagination__prev">' . str_replace( '?limitstart=0', '', $list[ 'previous' ][ 'data' ] )
            . '</li>';
    }

    $prev_href = null;

    preg_match( '#(href=").*?(")#', $list[ 'previous' ][ 'data' ], $prev_a );

    if ( count( $prev_a ) > 0 ) {
        $prev_href = str_replace( array( 'href="/', '"' ), "", $prev_a[ 0 ] );
    }

    if ( isset( $prev_href ) ) {
        $doc->addCustomTag( '<link rel="prev" href="' . JURI::base() . $prev_href . '">' );
    }

    foreach ( $list[ 'pages' ] as $k => $page ) {
        if ( in_array( $k, range( $range * $step - ( $step + 1 ), $range * $step ) ) ) {
            if ( ( $k % $step == 0 || $k == $range * $step - ( $step + 1 ) )
                && $k != $currentPage && $k != $range * $step - $step )
            {
                $page[ 'data' ] = preg_replace( '#(<a.*?>).*?(</a>)#', '$1...$2', $page[ 'data' ] );
            }
        }

        $html .= '<li class="pagination__number' . ( $k == $currentPage ? ' active': '' ) . '">'
            . str_replace( '?limitstart=0', '', $page[ 'data' ] ) . '</li>';
    }

    if ( $list[ 'next' ]['active'] ) {
        $html .= '<li class="pagination__next">' . $list[ 'next' ][ 'data' ] . '</li>';
    }

    $next_href = null;

    preg_match( '#(href=").*?(")#', $list[ 'next' ][ 'data' ], $next_a );

    if ( count( $next_a ) > 0 ) {
        $next_href = str_replace( array( 'href="/', '"' ), "", $next_a[ 0 ] );
    }

    if ( isset( $next_href ) ) {
        $doc->addCustomTag( '<link rel="next" href="' . JURI::base() . $next_href . '">' );
    }

    $html .= '</ul>';

    return $html;
}