<?php
/**
 * Creates the Footer
 * 
 * @package UZHSLNamespace
 */

$menu_class = UZHSLNamespace\classes\Menus::get_instance();
?>

<div class="uzhsl-footer sm-row" id="uzhsl-footer">
    <div class="uzhsl-footer__content sm-block">
        <div class="uzhsl-footer__column uzhsl-footer__summary sm-col sm-large-3 sm-small-6">
            <?php echo get_field('summary', 'option') ?>
        </div>
        <div class="uzhsl-footer__column uzhsl-footer__menu sm-col sm-large-5 sm-small-6">
            <?php get_template_part( 'template_parts/elements', 'social-media' ) ?>
            <?php get_template_part( 'template_parts/main', 'footer-nav' ) ?>
        </div>
        <div class="uzhsl-footer__column uzhsl-footer__address sm-col sm-large-3 sm-small-6">

            <div class="uzhsl-footer__address__logo">
                <?php echo wp_get_attachment_image( get_field('logo_white', 'option') ); ?>
            </div>
            <?php echo get_field('address', 'option') ?>
        </div>
    </div>
    <div class="uzhsl-footer__copyright sm-block">
        <?php
        printf(
            '©%1$s Human Aspects of Software Engineering Lab | Website by <a href="%2$s">Salemoche</a>',
            date("Y"),
            DEVELOPER_URL
        );
        ?>
    </div>
</div>