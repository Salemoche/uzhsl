<?php
/**
 * Creates the Footer
 * 
 * @package HaselNamespace
 */

$menu_class = HaselNamespace\classes\Menus::get_instance();
$footer_menu_id = $menu_class->get_menu_id('hasel-footer-menu');
$footer_menu = wp_get_nav_menu_items( $footer_menu_id );
$the_post_id = $post ? $post->ID : 0;
?>

<nav class="hasel-footer-navigation">

    <div class="hasel-footer-navigation hasel-footer-menu" id="footer-menu">
        <?php
        if ( !empty( $footer_menu ) && is_array( $footer_menu) ) :
            ?>
            <ul class="footer-menu__list">

                <?php 
                foreach ( $footer_menu as $menu_item ) :
                    if( !$menu_item->menu_item_parent ) :

                        $child_menu_items = $menu_class->get_child_menu_items($footer_menu, $menu_item->ID);
                        $has_children = is_array($child_menu_items) && !empty( $child_menu_items );
                        $related_post_id = $menu_item->object_id;
                        $is_current_class = $related_post_id == $the_post_id ? "menu-item--current" : "";

                        
                        if ( !$has_children) : 
                            ?>
                            <li class="footer-menu__list__item menu-item footer-menu-item <?php echo $is_current_class; ?>">
                                <a class="footer-menu-item__link menu-item__link" href="<?php echo esc_url( $menu_item->url ) ?> "><?php echo esc_html( $menu_item->title )?></span></a>
                            </li>
                            <?php 
                        else : 
                        endif;
                        ?>

                        <?php
                    endif;
                endforeach;
                ?>
            </ul>
            <?php
        endif;
        ?>
    </div>
</nav>