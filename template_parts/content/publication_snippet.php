<?php
/**
*========================================
*	
*	Publication Snippet Section Template
*
*   @package Hasel 
*
*========================================*/

$args = wp_parse_args(
    $args,
    array(
        'content'   => []
    )
);

$content = $args['content'];

?>
<section class="hsl-section sm-block hsl-section-publication-snippet">
    <?php echo $content['publication_snippet']; ?>
</section>
