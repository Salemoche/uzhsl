<?php
/**
*========================================
*	
*	Tile Template
*
*   @package Hasel 
*
*========================================*/


$args = wp_parse_args(
    $args,
    array(
        'type'   => '',
        'slides'   => [],
    )
);

$type = $args['type'];
$slides = $args['slides'];

?>

<div class="hsl-slider swiper">
    <div class="swiper-wrapper">
    <?php foreach ($slides as $slide) :?>
        <div class="swiper-slide">
        <?php if ( $type === 'publication') : ?>
            <div class="hsl-slide hsl-slide-publication">
                <?php createStandardBlock($slide, 'card') ?>
            </div>
        <?php elseif ( $type === 'image') : ?>
            <div class="hsl-slide hsl-slide-image">
                <?php echo wp_get_attachment_image($slide, 'large'); ?>
            </div>
        <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div>