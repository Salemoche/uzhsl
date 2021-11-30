<?php
/**
*========================================
*	
*	Publication Slider Section Template
*
*   @package Hasel 
*
*========================================*/

$args = wp_parse_args(
    $args,
    array(
        'content'   => []
    )
);

$content = $args['content'];
$button = $content['button'] ?: [];
$selected_posts = $content['publication_slider'];

?>
<section class="hsl-section sm-block hsl-section-publication-slider">
    <?php echo isset( $content['title'] ) ? '<h2 class="section-title">' . $content['title'] . '</h2>' : ''; ?>

    <?php get_template_part( 'template_parts/elements/slider', '', [ 'slides' => $selected_posts, 'type' => 'publication' ] ); ?>

    <?php if( !empty( $button ) ):
        echo '<div class="section__link-container">';
            echo '<a class="section__link hsl-button"'; 
                echo isset($button['url']) ? 'href="' . $button['url'] . '" ' : '';
                echo isset($button['target']) ? 'target="' . $button['target'] . '"' : '';
            echo '>';
                echo '<span>' . $button['title'] . '</span>' ?: '';
            echo '</a>';
        echo '</div>';
    endif; ?>
</section>
