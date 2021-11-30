<?php
/**
*========================================
*	
*	Team Section Template
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

$site_id = $content['site_id'];
$research_groups = get_field('research_groups', 'option');
$fetch_url = '';
$content_id = uniqid('hsl-tile-container-', false);
$sort_order = $content['team_members'];


foreach ($research_groups as $research_group) {
    if ( $research_group['site_id'] == $site_id) {
        $fetch_url = $research_group['url'];
    }
}

?>
<section class="hsl-section sm-block hsl-section-publication-slider" id="<?php echo $content_id ?>">
    <div class="hsl-tile-container sm-block">
        <?php 
            echo $content['title'] !== "" ? '<h2>' . $content['title'] . '</h2>' : ''; 

            get_template_part( 'template_parts/fetch-external-content', '', [ 'content_id' => $content_id, 'url' => $fetch_url, 'type' => 'team', 'options' => 'team?_embed', 'sort_order' => $sort_order ] );
        ?>
    </div>
</section>
