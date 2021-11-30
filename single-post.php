<?php
/**
 * Single Post Template
 * 
 * @package UZHSL
 */

get_header();

?>

<div class="uzhsl-content uzhsl-single uzhsl-single-post">
    <?php echo get_template_part('template_parts/content', '', [ 'type' => 'blog' ] ); ?>
</div>

<?php get_footer(); ?>