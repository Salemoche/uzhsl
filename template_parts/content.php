<?php
/**
*========================================
*	
*	Content Template
*
*   @package UZHSL 
*
*========================================*/

$args = wp_parse_args(
    $args,
    array(
        'type'   => []
    )
);

$type = $args['type'];

if ( get_field('content') !== null && !empty( get_field('content')) ){

    $index = 0;

    foreach ( get_field('content') as $section) {
        switch ($section['acf_fc_layout']) {
            case 'standard_layout':
                get_template_part('template_parts/content/standard', '', [ 'content' => $section, 'index' => $index, 'type' => $type ]);
                break;
            case 'news_layout':
                get_template_part('template_parts/content/news', '', [ 'content' => $section ]);
                break;
            case 'publication_slider_layout':
                get_template_part('template_parts/content/publication_slider', '', [ 'content' => $section ]);
                break;
            case 'selected_projects_layout':
                get_template_part('template_parts/content/selected_projects', '', [ 'content' => $section ]);
                break;
            case 'selected_projects_external_layout':
                get_template_part('template_parts/content/selected_projects-external', '', [ 'content' => $section ]);
                break;
            case 'publication_snippet_layout':
                get_template_part('template_parts/content/publication_snippet', '', [ 'content' => $section ]);
                break;
            case 'team_layout':
                get_template_part('template_parts/content/team', '', [ 'content' => $section ]);
                break;
            case 'team_external_layout':
                get_template_part('template_parts/content/team-external', '', [ 'content' => $section ]);
                break;
            case 'tile_layout':
                get_template_part('template_parts/content/tile', '', [ 'content' => $section ]);
                break;
            default:
                # code...
                break;
        }
        $index ++;
    }
}

// if( have_rows('content') ){ 
//     while ( have_rows('content') ) { 
//         the_row();
        
//         $type = '';
//         $content = null;

//         switch (get_row_layout()) {
//             case 'standard_layout':
//                 $type = 'standard';
//                 $content = get_template_part('template_parts/content/standard', '', [ 'content' => '' ]);
//             default:
//                 # code...
//                 break;
//         }

//         echo '<section class="uzhsl-section sm-block uzhsl-section-' . $type . '">' . $content . '</section>';
//     }
// }

?>
