<?php
/**
*========================================
*	
*	Tile Template
*
*   @package UZHSL 
*
*========================================*/


$args = wp_parse_args(
    $args,
    array(
        'type'   => '',
        'id'   => '',
        'content'   => [],
    )
);

$type = $args['type'] ?: 'regular';
$content = $args['content'];
$post_id = $args['id'] ?: get_the_id();
$image_id = has_post_thumbnail( $post_id ) ? get_post_thumbnail_id( $post_id ) : get_field('logo_white', 'option');
$image_type = has_post_thumbnail( $post_id ) ? 'thumbnail' : 'placeholder';
$date = $post->post_type == 'post' ? $post->post_date : '';
$position = get_field( 'position', $post_id ) ?: '';
$additional_content = get_field( 'tile_content', $post_id ) ?: null;

?>

<div class="uzhsl-tile uzhsl-tile-<?php echo $type; ?>" data-href="<?php echo get_permalink( $post_id ) ?>">
    <div class="uzhsl-tile-wrapper">
        <?php echo isset($image_id) && $type !== 'no_image' ? '<div class="tile__image uzhsl-tile-image uzhsl-tile-image-' . $image_type . '">' . wp_get_attachment_image( $image_id, 'medium' ) . '</div>' : '' ?>
        <div class="tile__content">
            <?php if (isset($date) && $post->post_type == 'post'): ?>
            <div class="tile__meta">
                <span><?php echo get_the_date("d.m.Y");?></span>
                <span>by <?php echo get_the_author_meta( 'user_firstname' ) . ' ' . get_the_author_meta( 'user_lastname' );?></span>
            </div>
            <?php endif; ?>
            <h5 class="tile__title"><?php echo get_the_title( ( $post_id ) ); ?></h5>
            <?php echo $position != "" ?  '<div class="tile__position">' . $position . '</div>' : '' ?>
            <?php echo $additional_content !== null ?  '<div class="tile__additional-content">' . $additional_content . '</div>' : '' ?>
            <?php get_template_part('template_parts/elements/tags', '', [ 'id' => $post_id ]) ?>
        </div>
    </div>
</div>