<?php
/**
*========================================
*	
*	Team Section Template
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
$selected_posts = $content['team_members'];

?>
<section class="uzhsl-section sm-block uzhsl-section-publication-slider">
    <div class="uzhsl-tile-container sm-block">
        <?php 
            echo $content['title'] !== "" ? '<h2>' . $content['title'] . '</h2>' : ''; 

            foreach ($selected_posts as $selected_post ) {
                get_template_part( 'template_parts/elements/tile', '', [ 'id' => $selected_post->ID, 'type' => 'team' ] );
                
            }
        ?>
    </div>
</section>
