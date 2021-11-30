<?php
/**
* Search Results
*
* @package Hasel
*/

get_header();
?>

<div class="hsl-search sm-block hsl-section">
    <h1 class="hsl-search-title"></h1>
    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();
    
        get_template_part( 'template_parts/elements/tile' );
    
    endwhile; endif; wp_reset_postdata();?>
</div>
    
<?php
get_footer();