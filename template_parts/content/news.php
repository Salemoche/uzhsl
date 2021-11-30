<?php
/**
*========================================
*	
*	News Section Template
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

?>
<section class="uzhsl-section sm-block uzhsl-section-news">
    <?php echo isset( $content['title'] ) ? '<h2 class="section-title">' . $content['title'] . '</h2>' : ''; ?>

    <div class="uzhsl-tile-container sm-block">
        <?php
        // The Query
        $args = [
            'post_type'		=>	'post',
            'posts_per_page'=>  '8'
        ];
        $query = new WP_Query( $args );
        
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
        
            get_template_part( 'template_parts/elements/tile' );
        
        endwhile; endif; wp_reset_postdata();?>
    </div>
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
