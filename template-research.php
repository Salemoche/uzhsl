<?php
/**
* Template Name: Research
*
* @package Hasel
*/

get_header();
?>

<div class="hsl-content hsl-research">
    <div class="hsl-research__header hsl-header">
        <div class="hsl-column">
            <?php the_title(); ?>
            <?php the_field( 'lead' ); ?>
        </div>
        <div class="hsl-column">
            <?php get_the_post_thumbnail( get_the_ID(), 'large' )?>
        </div>
    </div>
    <div class="hsl-research__list">
        <?php
        // The Query
        $args = [
            'post_type'		=>	'research'
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