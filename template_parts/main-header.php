<?php
/**
 * Creates the Navigation Menu
 * 
 * @package HaselNamespace
 */

$menu_class = HaselNamespace\classes\Menus::get_instance();
$header_menu_id = $menu_class->get_menu_id('hasel-header-menu');
$header_menu = wp_get_nav_menu_items( $header_menu_id );
$the_post_id = $post ? $post->ID : 0;
?>

<nav class="navbar hsl-navigation sm-row">

    <div class="hsl-navigation-container sm-block">

        <a href="<?php echo get_home_url( ) ?> " class="hsl-navigation__logo sm-col sm-small-3 sm-medium-2 sm-large-2">
            <?php echo wp_get_attachment_image( get_field('logo_color', 'option') ); ?>
        </a>

        <div class="hsl-navigation__menu hsl-header-menu sm-col sm-small-3 sm-large-10" id="header-menu">
            <?php
            if ( !empty( $header_menu ) && is_array( $header_menu) ) :
                ?>
                <ul class="header-menu__list">

                    <?php 
                    foreach ( $header_menu as $menu_item ) :
                        if( !$menu_item->menu_item_parent ) :

                            $child_menu_items = $menu_class->get_child_menu_items($header_menu, $menu_item->ID);
                            $has_children = is_array($child_menu_items) && !empty( $child_menu_items );
                            $related_post_id = $menu_item->object_id;
                            $is_current_class = $related_post_id == $the_post_id ? "menu-item--current" : "";

                            
                            if ( !$has_children) : 
                                ?>
                                <li id="menu-item-<?php echo $menu_item->ID; ?>" class="header-menu__list__item menu-item header-menu-item <?php echo $is_current_class;?>">
                                    <a class="header-menu-item__link menu-item__link" href="<?php echo esc_url( $menu_item->url ) ?> "><?php echo esc_html( $menu_item->title )?></span></a>
                                </li>
                                <?php 
                            else : 
                                ?>
                                <li class="header-menu__list__item menu-item header-menu-item header-menu-item-dropdown <?php echo $is_current_class; ?>">
                                    <a class="header-menu-item__link menu-item__link" href="<?php echo esc_url( $menu_item->url ) ?> ">
                                        <?php echo esc_html( $menu_item->title ) ?> 
                                    </a>
                                    <?php
                                    foreach ( $child_menu_items as $child_menu_item ) :
                                        ?>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="<?php echo esc_url( $child_menu_item->url ) ?>"><?php echo esc_html( $child_menu_item->title ) ?></a>
                                        </div>
                                        <?php
                                    endforeach;
                                    ?>
                                </li>
                                <?php 
                            endif;
                            ?>

                            <?php
                        endif;
                    endforeach;

                    if ( isset($languages) && count($languages) > 1) :          
                        get_template_part( 'template_parts/elements/language-links', '', ['languages' => $languages]);
                    endif;
                    ?>
                </ul>
                <?php
            endif;
            ?>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
        </div>

        <div class="hsl-navigation__button"></div>
    </div>
</nav>