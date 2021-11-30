<?php
/**
 *  Theme Functions
 * 
 *  @package Hasel
 */

// echo '<pre>';
// print_r (HASEL_DIR_PATH);
// wp_die();

if ( !defined('HASEL_DIR_PATH')) {
    define( 'HASEL_DIR_PATH', untrailingslashit( get_template_directory() ));
}

if ( !defined('HASEL_DIR_URI')) {
    define( 'HASEL_DIR_URI', untrailingslashit( get_template_directory_uri() ));
}

if ( !defined('HASEL_PLUGINS_PATH')) {
    define( 'HASEL_PLUGINS_PATH', untrailingslashit( $plugin_dir = ABSPATH . 'wp-content/plugins/' ) );
}

// if ( !defined('HASEL_PLUGINS_URI')) {
//     define( 'HASEL_PLUGINS_URI', untrailingslashit( plugin_dir_url() ));
// }

if ( !defined('HASEL_BUILD_URI')) {
    define( 'HASEL_BUILD_URI', untrailingslashit( get_template_directory_uri() . '/assets/build' ));
}

if ( !defined('HASEL_BUILD_PATH')) {
    define( 'HASEL_BUILD_PATH', untrailingslashit( get_template_directory() . '/assets/build' ));
}

if ( !defined('HASEL_BUILD_JS_DIR_PATH')) {
    define( 'HASEL_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/js' ));
}

if ( !defined('HASEL_BUILD_JS_URI')) {
    define( 'HASEL_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/js' ));
}

if ( !defined('HASEL_BUILD_IMG_URI')) {
    define( 'HASEL_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/img' )); 
}

if ( !defined('HASEL_BUILD_CSS_URI')) {
    define( 'HASEL_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/css' ));
}

if ( !defined('HASEL_BUILD_CSS_DIR_PATH')) {
    define( 'HASEL_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/css' ));
}

if ( !defined('HASEL_BLOCK_TEMPLATE_DIR')) {
    define( 'HASEL_BLOCK_TEMPLATE_DIR', untrailingslashit( get_template_directory() .  '/block-templates/'));
}

if ( !defined('DEVELOPER_URL')) {
    define( 'DEVELOPER_URL', 'https://inter-action.design' );
}

//require_once HASEL_DIR_PATH . '/inc/helpers/autoloader.php';
require_once HASEL_DIR_PATH . '/vendor/autoload.php';
require_once HASEL_DIR_PATH . '/inc/helpers/template-tags.php';
// require_once HASEL_PLUGINS_PATH . '/salemoche-wordpress-essentials/inc/helpers/helpers.php';

function hasel_get_theme_instance() {
    \HaselNamespace\classes\Theme::get_instance();
}

hasel_get_theme_instance();

?>