<?php
/**
*========================================
*	
*	Footer Social Media Template
*
*   @package UZHSLNamespace
*
*========================================*/

?>

<div class="uzhsl-social-media sm-block">
    <h5 class="uzhsl-social-media__title"><?php echo esc_html( get_field( 'social_media_title', 'option' )); ?></h5>
    <?php
    if( have_rows('social_media', 'option') ): while( have_rows('social_media', 'option') ) : the_row();?>
        <a class="uzhsl-social-media__item" href="<?php echo get_sub_field( 'social_media_link', 'option' ); ?>">
            <?php echo wp_get_attachment_image( get_sub_field( 'social_media_icon', 'option' )); ?>
        </a>
    <?php endwhile; endif; ?>
</div>
