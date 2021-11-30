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
        'id'   => null,
        'column'   => [],
        'index' => 0,
        'position' => '',
        'type' => ''
    )
);

$post_id = $args['id'] ?: get_the_ID();
$column = $args['column'];
$index = $args['index'];
$position = $args['position'];
$type = $args['type'];

?>

<?php foreach ($column as $column_content) :
    if ( $column_content['title'] == 'page' ) {
        echo '<' . $column_content['title_tag'] . ' class="section__title">' . get_the_title() . '</' . $column_content['title_tag'] . '>'; 
    } elseif ( $column_content['title'] !== 'none' ) {
        echo '<' . $column_content['title_tag'] . ' class="section__title">' . $column_content['title'] . '</' . $column_content['title_tag'] . '>'; 
    }
    ?>
    <!-- Position -->
    <?php if( get_field('position') !== null && $index == 0 && $position == 'left'): 
        echo '<h3 class="section__position">' . get_field('position') . '</h3>';
    endif; ?>
    <!-- Categories -->
    <?php if( $column_content['show_categories'] ): 
        get_template_part('template_parts/elements/tags', '', [ 'id' => $post_id]);
    endif; ?>
    <!-- Text -->
    <?php if( $column_content['text'] !== null ): 
        echo '<div class="section__text">' . $column_content['text'] . '</div>';
    endif; ?>
    <!-- Button -->
    <?php if( !empty( $column_content['button'] )):
        echo '<div class="section__link-container">';
            echo '<a class="section__link uzhsl-button"'; 
                echo isset($column_content['button']['url']) ? 'href="' . $column_content['button']['url'] . '" ' : '';
                echo isset($column_content['button']['target']) ? 'target="' . $column_content['button']['target'] . '"' : '';
            echo '>';
                echo '<span>' . $column_content['button']['title'] . '</span>' ?: '';
            echo '</a>';
        echo '</div>';
    endif; ?>
    <!-- Image / Slider -->
    <?php 
    $images = $column_content['images'] ?: [];

    if ( !empty( $images ) || ($column_content['use_thumbnail'] && has_post_thumbnail( )) ):
        $is_slider = count($images) > 1;
        $media_class = $is_slider ? 'slider' : 'image';
        $is_profile_picture = $column_content['is_profile_picture'] ? ' uzhsl-image-profile' : '';

        ?>
        <div class="section__media section__<?php echo $media_class ?> uzhsl-<?php echo $media_class ?><?php echo $is_profile_picture ?>">
            <?php if( $is_slider ): 
            
                get_template_part( 'template_parts/elements/slider', '', [ 'slides' => $images, 'type' => 'image' ] );
                
            else: 
                if ( $column_content['use_thumbnail'] ) {
                    the_post_thumbnail( 'large' );
                } else {
                    echo wp_get_attachment_image($images[0], 'large');
                }
            endif; ?>
        </div>
    <?php elseif ( $column_content['video'] !== null ): ?>
        <div class="section__media section__video uzhsl-video">
            <?php echo $column_content['video'] ?>
        </div>
    <?php endif; ?>
    <!-- Meta Box -->
    <?php 
    $meta_box = [];

    if ( $column_content['use_standard_meta_box'] && !empty( get_field( 'meta_box_standard' ))) {
        $meta_box = get_field( 'meta_box_standard' );
    } else if ( !$column_content['use_standard_meta_box'] && $column_content['meta_box'] ) {
        $meta_box = $column_content['meta_box'];
    }

    if ( !empty( $meta_box ) ): ?>
        <table class="section__meta-box uzhsl-meta-box>">
            <tbod>
            <?php foreach ($meta_box as $item): ?>
                <tr class="uzhsl-meta-box__item">
                    <td class="uzhsl-meta-box__item__title">
                        <?php echo $item['title']; ?>
                    </td>
                    <td class="uzhsl-meta-box__item__text">
                        <?php echo $item['text']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
<?php endforeach;?>