<?php
/**
*========================================
*	
*	Publication Slider Section Template
*
*   @package UZHSL 
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

$site_id = $content['site_id'];
$research_groups = get_field('research_groups', 'option');
$fetch_url = '';
$content_id = uniqid('uzhsl-publication-slider-', false);
$selected_publications = $content['publication_slider'];


foreach ($research_groups as $research_group) {
    if ( $research_group['site_id'] == $site_id) {
        $fetch_url = $research_group['url'];
    }
}

?>
<section class="uzhsl-section sm-block uzhsl-section-publication-slider">
    <?php echo isset( $content['title'] ) ? '<h2 class="section-title">' . $content['title'] . '</h2>' : ''; ?>


    <div class="uzhsl-slider swiper">
        <div class="swiper-wrapper"  id="<?php echo $content_id ?>"></div>
        <div class="swiper-pagination"></div>
    </div>

    <?php get_template_part( 'template_parts/fetch-external-content', '', [ 'content_id' => $content_id, 'type' => 'publication', 'options' => 'publication?_embed', 'sort_order' => $selected_publications, 'site_id' => $site_id ] ); ?>

    <?php if( !empty( $button ) ):
        echo '<div class="section__link-container">';
            echo '<a class="section__link uzhsl-button"'; 
                echo isset($button['url']) ? 'href="' . $button['url'] . '" ' : '';
                echo isset($button['target']) ? 'target="' . $button['target'] . '"' : '';
            echo '>';
                echo '<span>' . $button['title'] . '</span>' ?: '';
            echo '</a>';
        echo '</div>';
    endif; ?>
</section>
