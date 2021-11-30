<?php
/**
* Template Name: People
*
* @package Hasel
*/

get_header();
?>

<div class="hsl-content hsl-people">
    <?php echo get_template_part('template_parts/content' ); ?>
    
    <div class="hsl-people__grid">
        <?php
        // The Query
        $args = [
            'post_type'		=>	'team'
        ];
        $query = new WP_Query( $args );
        
        // The Query
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
        
            the_title();
        
        endwhile; endif; wp_reset_postdata();?>
    </div>
</div>
    
<?php
get_footer();