<?php
/**
 * Single Post Template
 * 
 * @package Hasel
 */

get_header();

?>

<div class="hsl-content hsl-single hsl-single-post">
    <?php echo get_template_part('template_parts/content', '', [ 'type' => 'blog' ] ); ?>
</div>

<?php get_footer(); ?>