<?php
/**
*========================================
*	
*	Tile Template
*
*   @package Hasel 
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
    echo '<div class="tile__tags hsl-tags">';
    foreach ($post_categories as $category) {
        echo '<div class="hsl-button hsl-button--small hsl-tag" data-href="' . $category->name . '" ><span>' . $category->name . '</span></div>';
    }
    echo '</div>';
}
?>