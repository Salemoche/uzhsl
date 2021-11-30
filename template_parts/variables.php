<?php
/**
*========================================
*	
*	Variables
*
*   @package Scientifica
*
*========================================*/


/**
*========================================
*	
*	Create JS Variables from Post Meta
*
*========================================*/

$page_variables = [];
$colors = [];

// The Query
$args = [
    'post_type'		=>	'page'
];
$query = new WP_Query( $args );

$variable_index = 1;

// The Loop
if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

    $variable_name = $post->post_name;
    $variable = [
        'id' => get_the_ID()
    ];

    $page_variables[$variable_name] = $variable;
    $variable_index ++;

    $colors['color1'] = get_field('color_1', 'option');
    $colors['color2'] = get_field('color_2', 'option');
    $colors['color3'] = get_field('color_3', 'option');
    $colors['color4'] = get_field('color_4', 'option');
    $colors['color5'] = get_field('color_5', 'option');
    $colors['color6'] = get_field('color_6', 'option');
    $colors['color7'] = get_field('color_7', 'option');

    $research_groups = get_field('research_groups', 'option');

    endwhile; endif; wp_reset_postdata();
?>

<script>
    window.salemoche = {...window.salemoche}
    window.salemoche.pageVariables = <?php echo json_encode($page_variables) ?>; 
    window.salemoche.colors = <?php echo json_encode($colors) ?>; 
    window.salemoche.researchGroups = <?php echo json_encode($research_groups) ?>; 

    const rootStyle = document.querySelector(':root').style;

    rootStyle.setProperty('--color-1', window.salemoche.colors.color1);
    rootStyle.setProperty('--color-2', window.salemoche.colors.color2);
    rootStyle.setProperty('--color-3', window.salemoche.colors.color3);
    rootStyle.setProperty('--color-4', window.salemoche.colors.color4);
    rootStyle.setProperty('--color-5', window.salemoche.colors.color5);
    rootStyle.setProperty('--color-6', window.salemoche.colors.color6);
    rootStyle.setProperty('--color-7', window.salemoche.colors.color7);
    
    // console.log(window.salemoche.researchGroups)
    
    // Object.keys(window.variables).forEach((variable, index) => {
    //     let id = window.variables[variable].id;
    //     let colors = window.variables[variable].colors;

    //     document.documentElement.style.setProperty(`--color-${id}-light`, colors.light);
    // });

</script>