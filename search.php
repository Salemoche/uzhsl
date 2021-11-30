<?php
/**
* Search Results
*
* @package UZHSL
*/

get_header();
?>

<div class="uzhsl-search sm-block uzhsl-section">
    <h1 class="uzhsl-search-title"></h1>
    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();
    
        get_template_part( 'template_parts/elements/tile' );
    
    endwhile; endif; wp_reset_postdata();?>
</div>
    
<?php
get_footer();