<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined( '_JEXEC' ) or die;

JHtml::addIncludePath( JPATH_COMPONENT . '/helpers' );

// Create shortcuts to some parameters.
$params = $this->item->params;
$images = json_decode( $this->item->images );
$item = $this->item;
$urls = json_decode( $this->item->urls );
$canEdit = $params->get( 'access-edit' );
$user = JFactory::getUser();
$info = $params->get( 'info_block_position', 0 );

// Check if associations are implemented. If they are, define the parameter.
$assocParam = ( JLanguageAssociations::isEnabled() && $params->get( 'show_associations' ) );
JHtml::_( 'behavior.caption' );
?>

<?php
if ( $params->get( 'show_title' ) ) : ?>

    <h1>
        <?= $this->escape( $item->title ) ?>
    </h1>

<?php
endif; ?>

<?php
// Находим дополнительные фотографии
$additionalPhotos = [];
foreach ( $item->jcfields as $field ) {
    if ( $field->name == 'catalog-additional-photos' ) {
        $params = $field->fieldparams->toArray();
        $dir = $params[ 'directory' ];

        if ( is_array( $field->rawvalue ) ) {
            foreach ( $field->rawvalue as $image ) {
                $additionalPhotos[] = '/images/' . $dir . '/' . $image;
            }
        } elseif ( !empty( $field->rawvalue ) ) {
            $additionalPhotos[] = '/images/' . $dir . '/' . $field->rawvalue;
        }
    }
}
?>

    <div class="row">
        <div class="col-md-4">
            <div class="slider slick-slider js-slider-product">
                <div class="img">
                    <img class="img-border img-responsive" src="<?= $images->image_intro ?>"
                         alt="<?= ( $images->image_intro_alt ? $images->image_intro_alt : $this->item->title ) ?>">
                </div>

                <?php
                foreach ( $additionalPhotos as $image ): ?>

                    <div class="img">
                        <img class="img-border img-responsive" src="<?= $image ?>">
                    </div>

                <?php
                endforeach; ?>
            </div>

        </div>
        <div class="col-md-8">
            <div class="block-action <?= ( strlen( $item->fulltext ) ? 'block-action--border' : '' ) ?>">
                <div class="row">
                    <div class="col-sm-6 col-md-7 block-action__text">
                        <?= $item->introtext ?>
                    </div>
                    <div class="col-sm-6 col-md-5 block-action__btn">
                        <a class="btn btn__action" href="#" data-toggle="modal" data-target="#modal-price" data-ym="FORM_PRICE_OPEN">Получить прайс</a>
                    </div>
                </div>
            </div>

            <?= $item->fulltext ?>
        </div>
    </div>

<script>
    $( function () {
        $( '.js-slider-product' ).slick( {
            dots: <?= count( $additionalPhotos ) > 0 ? 'true' : 'false' ?>,
            arrows: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2500,
            fade: true,
            cssEase: 'linear',
            adaptiveHeight: true
        } );
    } );
</script>