<?php
/**
*========================================
*	
*	Selected Projects Section Template
*
*   @package Hasel 
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
<section class="hsl-section sm-block hsl-section-selected-projects">
    <?php 
    
    echo isset( $content['title'] ) ? '<h2>' . $content['title'] . '</h2>' : ''; 
    
    foreach ($selected_posts as $selected_post) {
        createStandardBlock($selected_post, 'card');
    }


    ?>

    <?php if( !empty( $button ) ):
        echo '<div class="section__link-container">';
            echo '<a class="section__link hsl-button"'; 
                echo isset($button['url']) ? 'href="' . $button['url'] . '" ' : '';
                echo isset($button['target']) ? 'target="' . $button['target'] . '"' : '';
            echo '>';
                echo '<span>' . $button['title'] . '</span>' ?: '';
            echo '</a>';
        echo '</div>';
    endif; ?>
</section>
