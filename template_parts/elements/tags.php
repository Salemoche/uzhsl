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
        'id'    => null
    )
);

$type = $args['type'];
$post_id = $args['id'] ?: get_the_ID();

$post_categories = salemoche_get_categories($post_id);

if( !empty($post_categories)) {
    echo '<div class="tile__tags uzhsl-tags">';
    foreach ($post_categories as $category) {
        echo '<div class="uzhsl-button uzhsl-button--small uzhsl-tag" data-name="' . $category->name . '"><span>' . $category->name . '</span></div>';
    }
    echo '</div>';
}
?>