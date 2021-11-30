<?php
/**
*========================================
*	
*	Tile Template
*
*   @package UZHSL 
*
*========================================*/


$args = wp_parse_args(
    $args,
    array(
        'type'   => '',
    )
);

$type = $args['type'];

?>

<div class="uzhsl-slider swiper">
    <div class="swiper-wrapper">
    <!-- < ?php foreach ($slides as $slide) :?>
        <div class="swiper-slide">
        < ?php if ( $type === 'publication') : ?>
            <div class="uzhsl-slide uzhsl-slide-publication">
                < ?php createStandardBlock($slide, 'card') ?>
            </div>
        < ?php elseif ( $type === 'image') : ?>
            <div class="uzhsl-slide uzhsl-slide-image">
                < ?php echo wp_get_attachment_image($slide, 'large'); ?>
            </div>
        < ?php endif; ?>
        </div>
        < ?php endforeach; ?>
    </div> -->
    <div class="swiper-pagination"></div>
</div>