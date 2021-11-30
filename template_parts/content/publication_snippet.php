<?php
/**
*========================================
*	
*	Publication Snippet Section Template
*
*   @package UZHSL 
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
<section class="uzhsl-section sm-block uzhsl-section-publication-snippet">
    <?php echo $content['publication_snippet']; ?>
</section>
