<?php
/**
* Template Name: Research
*
* @package UZHSL
*/

get_header();
?>

<div class="uzhsl-content uzhsl-research">
    <div class="uzhsl-research__header uzhsl-header">
        <div class="uzhsl-column">
            <?php the_title(); ?>
            <?php the_field( 'lead' ); ?>
        </div>
        <div class="uzhsl-column">
            <?php get_the_post_thumbnail( get_the_ID(), 'large' )?>
        </div>
    </div>
    <div class="uzhsl-research__list">
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