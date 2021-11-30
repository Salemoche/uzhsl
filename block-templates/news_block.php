<?php

/** =============================================
*
*   Standard block
*
*   @package Hasel
*   
* ============================================= */

$id = $block['id'];

?>

<div class="hsl-news-block news-block" id="<?php echo $id; ?>">
    <div class="news-block__title"><?php the_field('title'); ?></div>
    <?php
    // The Query
    $args = [
        'post_type'		=>	'post'
    ];
    $query = new WP_Query( $args );
    
    // The Query
    if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
    
        the_title();
    
    endwhile; endif; wp_reset_postdata();?>
</div>