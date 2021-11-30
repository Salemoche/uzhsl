<?php
/**
*========================================
*	
*	Selected Projects Section Template
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
$selected_posts = $content['selected_projects'];

?>
<section class="uzhsl-section sm-block uzhsl-section-selected-projects">
    <?php 
    
    echo isset( $content['title'] ) ? '<h2>' . $content['title'] . '</h2>' : ''; 
    ?>

    <div class="uzhsl-tile-container sm-block">
        <?php
        foreach ($selected_posts as $selected_post) {
            get_template_part( 'template_parts/elements/tile', '', [ 'type' => 'project', 'id' => $selected_post->ID ] );   
        }?>
    </div>

    <?php if( !empty( $button ) ):
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
