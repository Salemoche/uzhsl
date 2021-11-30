<?php
/**
*========================================
*	
*	Standard Section Template
*
*   @package Hasel 
*
*========================================*/

$args = wp_parse_args(
    $args,
    array(
        'id' => null,
        'content'   => [],
        'index' => 0,
        'type'  => ''
    )
);

$post_id = $args['id'] ?: get_the_ID();
$content = $args['content'];
$index = $args['index'];
$type = $args['type'];

// echo '<hr><pre class="sm-debug">';
// print_r($content);
// echo '</pre><hr>';
// wp_die();

$column_left = $content['column_left'] ?: [];
$column_right = $content['column_right'] ?: [];

?>
<section class="hsl-section hsl-section-standard hsl-section-<?php echo $type; ?>">
    <div class="hsl-section-wrapper sm-block">
        <div class="hsl-column hsl-column-left sm-col sm-large-<?php echo $content['column_width_left']; ?> sm-medium-6">
            <?php if ( $type === 'blog' ) : ?>
                <h3 class="hsl-blog-author">
                    <span><?php echo get_the_date("d.m.Y");?></span>
                    <span>by <?php echo get_the_author_meta('user_firstname', $post->post_author);?> <?php echo get_the_author_meta('user_lastname', $post->post_author);?></span>
                </h3>
            <?php endif; ?>
            <?php if ( !empty( $column_left ) ) {
                get_template_part( 'template_parts/elements/standard_column', '', [ 'id' => $post_id, 'column' => $column_left, 'type' => $type, 'position' => 'left', 'index' => $index ]); 
            } ?>
        </div>
        <div class="hsl-column hsl-column-right sm-col sm-large-<?php echo $content['column_width_right']; ?> sm-medium-6 ">
            <?php if ( !empty( $column_left ) ) {
                get_template_part( 'template_parts/elements/standard_column', '', [ 'id' => $post_id, 'column' => $column_right, 'type' => $type, 'position' => 'right', 'index' => $index ]); 
            } ?>
        </div>
        <?php  ?>
    </div>
</section>
