<?php
/**
* Template Name: Blog
*
* @package UZHSL
*/

get_header();
?>

<div class="uzhsl-content uzhsl-blog">
    <div class="uzhsl-section sm-block">
        <h1><?php the_title() ?></h1>
        <?php
        // The Query
        $args = [
            'post_type'		=>	'post'
        ];
        $query = new WP_Query( $args );
        
        echo '<div class="uzhsl-tile-container sm-block">';
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
        
            get_template_part( 'template_parts/elements/tile' );
        
        endwhile; endif; wp_reset_postdata();?>
        </div>
    </div>
</div>
    
<?php
get_footer();