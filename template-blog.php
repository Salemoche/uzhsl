<?php
/**
* Template Name: Blog
*
* @package Hasel
*/

get_header();
?>

<div class="hsl-content hsl-blog">
    <div class="hsl-section sm-block">
        <h1><?php the_title() ?></h1>
        <?php
        // The Query
        $args = [
            'post_type'		=>	'post'
        ];
        $query = new WP_Query( $args );
        
        echo '<div class="hsl-tile-container sm-block">';
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
        
            get_template_part( 'template_parts/elements/tile' );
        
        endwhile; endif; wp_reset_postdata();?>
        </div>
    </div>
</div>
    
<?php
get_footer();