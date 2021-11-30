<?php
/**
 *  Theme Functions
 * 
 *  @package UZHSL
 */

// echo '<pre>';
// print_r (UZHSL_DIR_PATH);
// wp_die();

if ( !defined('UZHSL_DIR_PATH')) {
    define( 'UZHSL_DIR_PATH', untrailingslashit( get_template_directory() ));
}

if ( !defined('UZHSL_DIR_URI')) {
    define( 'UZHSL_DIR_URI', untrailingslashit( get_template_directory_uri() ));
}

if ( !defined('UZHSL_PLUGINS_PATH')) {
    define( 'UZHSL_PLUGINS_PATH', untrailingslashit( $plugin_dir = ABSPATH . 'wp-content/plugins/' ) );
}

// if ( !defined('UZHSL_PLUGINS_URI')) {
//     define( 'UZHSL_PLUGINS_URI', untrailingslashit( plugin_dir_url() ));
// }

if ( !defined('UZHSL_BUILD_URI')) {
    define( 'UZHSL_BUILD_URI', untrailingslashit( get_template_directory_uri() . '/assets/build' ));
}

if ( !defined('UZHSL_BUILD_PATH')) {
    define( 'UZHSL_BUILD_PATH', untrailingslashit( get_template_directory() . '/assets/build' ));
}

if ( !defined('UZHSL_BUILD_JS_DIR_PATH')) {
    define( 'UZHSL_BUILD_JS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/js' ));
}

if ( !defined('UZHSL_BUILD_JS_URI')) {
    define( 'UZHSL_BUILD_JS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/js' ));
}

if ( !defined('UZHSL_BUILD_IMG_URI')) {
    define( 'UZHSL_BUILD_IMG_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/img' )); 
}

if ( !defined('UZHSL_BUILD_CSS_URI')) {
    define( 'UZHSL_BUILD_CSS_URI', untrailingslashit( get_template_directory_uri() . '/assets/build/css' ));
}

if ( !defined('UZHSL_BUILD_CSS_DIR_PATH')) {
    define( 'UZHSL_BUILD_CSS_DIR_PATH', untrailingslashit( get_template_directory() . '/assets/build/css' ));
}

if ( !defined('UZHSL_BLOCK_TEMPLATE_DIR')) {
    define( 'UZHSL_BLOCK_TEMPLATE_DIR', untrailingslashit( get_template_directory() .  '/block-templates/'));
}

if ( !defined('DEVELOPER_URL')) {
    define( 'DEVELOPER_URL', 'https://inter-action.design' );
}

//require_once UZHSL_DIR_PATH . '/inc/helpers/autoloader.php';
require_once UZHSL_DIR_PATH . '/vendor/autoload.php';
require_once UZHSL_DIR_PATH . '/inc/helpers/template-tags.php';
// require_once UZHSL_PLUGINS_PATH . '/salemoche-wordpress-essentials/inc/helpers/helpers.php';

function uzhsl_get_theme_instance() {
    \UZHSLNamespace\classes\Theme::get_instance();
}

uzhsl_get_theme_instance();

?>