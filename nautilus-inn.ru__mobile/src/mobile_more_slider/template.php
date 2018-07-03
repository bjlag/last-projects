<?php
if ( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode( true );

$extraCssClass = [];
if ( $arParams[ 'BACKGROUND_SHOW' ] == 'Y' ) {
    array_push( $extraCssClass, 'special-offers--bg' );
}
if ( $arParams[ 'ALWAYS_SHOW' ] == 'Y' ) {
    array_push( $extraCssClass, 'special-offers--always-show' );
} ?>

<div class="special-offers <?= implode( ' ', $extraCssClass ) ?>">

    <?php
    if ( isset( $arParams[ 'TITLE' ] ) && !empty( $arParams[ 'TITLE' ] ) ): ?>

        <div class="section-title">
            <?= $arParams[ 'TITLE' ] ?>
        </div>

    <?php
    endif; ?>

    <div class="js__special-offers">

        <?php
        foreach ( $arResult[ 'ITEMS' ] as $arItem ):
            $id = $arItem[ 'ID' ];
            $iblockId = $arItem[ 'IBLOCK_ID' ];
            $picture = $arItem[ 'PREVIEW_PICTURE' ];

            $this->AddEditAction( $id, $arItem[ 'EDIT_LINK' ], CIBlock::GetArrayByID( $iblockId, 'ELEMENT_EDIT' ) );
            $this->AddDeleteAction( $id, $arItem[ 'DELETE_LINK' ], CIBlock::GetArrayByID( $iblockId, 'ELEMENT_DELETE' ),
                array( "CONFIRM" => GetMessage( 'CT_BNL_ELEMENT_DELETE_CONFIRM' ) ) ); ?>

            <div id="<?= $this->GetEditAreaId( $id ); ?>" class="special-offers__item">
                <a href="<?= $arItem[ 'DETAIL_PAGE_URL' ] ?>">
                    <img class="special-offers__img" src="<?= $picture[ 'SRC' ] ?>" alt="<?= $arItem[ 'NAME' ] ?>">
                </a>
                <div class="special-offers__bottom clearfix">
                    <div class="special-offers__title">
                        <?= $arItem[ 'NAME' ] ?>
                    </div>
                    <a class="special-offers__read-more" href="<?= $arItem[ 'DETAIL_PAGE_URL' ] ?>">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

        <?php
        endforeach; ?>

    </div>
</div>