<?php
/**
*========================================
*	
*	Tile Section Template
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
$button = $content['button'] ?: [];
$tiles = $content['tiles'];

?>

<section class="uzhsl-section sm-block uzhsl-section-tile">
    <?php echo isset( $content['title'] ) ? '<h2 class="section-title">' . $content['title'] . '</h2>' : ''; ?>

    <div class="uzhsl-tile-container sm-block">
        <?php foreach ($tiles as $tile) {

            $post_id = $tile->ID;

            get_template_part( 'template_parts/elements/tile', '', [ 'type' => 'no_image', 'id' => $post_id] );

        }?>
    </div>
        <?php 
        if( !empty( $button ) ):
            echo '<div class="section__link-container">';
                echo '<a class="section__link uzhsl-button"'; 
                    echo isset($button['url']) ? 'href="' . $button['url'] . '" ' : '';
                    echo isset($button['target']) ? 'target="' . $button['target'] . '"' : '';
                echo '>';
                    echo '<span>' . $button['title'] . '</span>' ?: '';
                echo '</a>';
            echo '</div>';
        endif; ?>
</section>
