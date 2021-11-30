<?php

/** =============================================
*
*   Standard block
*
*   @package Hasel
*   
* ============================================= */

$id = $block['id'];

?>

<div class="hsl-_standard-block standard-block" id="<?php echo $id; ?>">
    <?php
    // Flexible Content
    if( have_rows('standard_content') ): while ( have_rows('standard_content') ) : the_row();
    
        if( get_row_layout() == 'text_layout' ): 
            $title_tag = get_sub_field( 'title_tag' );
        ?>
            <div class="standard-block__text" data-column-width="<?php the_sub_field( 'column_width_left' ); ?>">
                <?php echo '<' . $title_tag . ' class="standard-block__title">' . get_sub_field( 'title' ) . '</' . $title_tag . '>' ?>
                <?php if( get_sub_field( 'text' ) !== null ): 
                    echo '<div class="standard-block__text">' . the_sub_field( 'text' ) . '</div>';
                endif; ?>
                <?php if(  get_sub_field( 'button' ) !== null ):
                    echo '<a class="standard-block__link" 
                        href="' . get_sub_field( 'button' )['url'] . '" 
                        target="' . get_sub_field( 'button' )['target'] . '">' . 
                            get_sub_field( 'button' )['title'] . 
                        '</a>';
                endif; ?>
            </div>
        <?php elseif( get_row_layout() == 'image_layout' ): 
            $images = get_sub_field( 'images' );
            $is_slider = count($images) > 1;
            $media_class = $is_slider ? 'slider' : 'image';
            ?>
            <div class="standard-block__media standard-block__<?php echo $media_class ?>" data-column-width="<?php the_sub_field( 'column_width_left' ); ?>">
                <?php if( $is_slider ): foreach ($images as $image): ?>
                    <div class="standard-block__slider__slide">
                        <?php echo wp_get_attachment_image($images, 'large'); ?>
                    </div>
                <?php endforeach; else: 
                    echo wp_get_attachment_image($images[0], 'large');
                endif; ?>
            </div>
        <?php endif;
    
    endwhile; endif; ?>
</div>