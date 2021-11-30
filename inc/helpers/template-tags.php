<?php

function createStandardBlock ($selected_post, $type) {    

    $post_id = $selected_post->ID;

    $columns = [
        'column_left' => [
            [
                'title' => 'none',
                'title_tag' => '',
                'show_categories' => false,
                'text' => null,
                'use_standard_meta_box' => false,
                'meta_box' => [],
                'use_thumbnail' => false,
                'is_profile_picture' => false,
                'images' => [
                    get_post_thumbnail_id( $selected_post->ID )
                ],
                'video' => null
            ]
        ],
        'column_width_left' => '5',
        'column_right' => [
            [
                'title' => get_the_title( $post_id ),
                'title_tag' => 'h3',
                'show_categories' => true,
                'text' => get_the_excerpt( $post_id ),
                'use_standard_meta_box' => false,
                'meta_box' => [],
                'use_thumbnail' => false,
                'is_profile_picture' => false,
                'images' => [],
                'button' => [
                    'title' => 'read more',
                    'url' => get_the_permalink( $post_id )
                ],
                'video' => null
            ]
        ],
        'column_width_right' => '6',
    ];

    get_template_part( 'template_parts/content/standard', '', [ 'content' => $columns, 'type' => $type ] );
}