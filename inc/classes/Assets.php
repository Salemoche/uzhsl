<?php
/**
 * Enqueues all Assets
 * 
 * @package Hasel
 */

namespace HaselNamespace\classes;

use HaselNamespace\traits\Singleton;

class Assets {
    use Singleton;

    protected function __construct() {
        // Load class
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // Actions and filters

        add_action( 'wp_enqueue_scripts', [ $this, 'register_styles'] );
        add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts'] );
    }

    public function register_styles() {
        
        // Register Styles
        wp_register_style( 'style-css', get_stylesheet_uri(), [], filemtime( HASEL_DIR_PATH . '/style.css'), 'all' );
        wp_register_style( 'main-css', HASEL_BUILD_CSS_URI . '/main.css', [], filemtime( HASEL_BUILD_CSS_DIR_PATH . '/main.css'), 'all' );
        wp_register_style( 'swiper-css', 'https://unpkg.com/swiper@7/swiper-bundle.min.css', [], false, 'all' );
        
        // Enqueue Styles
        wp_enqueue_style('style-css');
        wp_enqueue_style('main-css');
        wp_enqueue_style('swiper-css');
    }

    public function register_scripts() {

        // Register Scripts
        wp_register_script( 'main-js', HASEL_BUILD_JS_URI . '/main.js', [ 'jquery' ], filemtime( HASEL_BUILD_JS_DIR_PATH . '/main.js'), true );
        wp_register_script( 'swpier-js', 'https://unpkg.com/swiper@7/swiper-bundle.min.js', [], false, false );
    
        // Enqueue Scripts
        wp_enqueue_script('main-js');
        wp_enqueue_script('swpier-js');
    }

    // public function enqueue_editor_assets() {
    //     $asset_config_file = sprintf('%s/assets.php', HASEL_BUILD_PATH);

    //     if ( !file_exists( $asset_config_file ) ) {
    //         return;
    //     }

    //     $asset_config = require_once $asset_config_file;

    //     if ( empty( $asset_config['js/editor.js'] ) ) {
    //         return;
    //     }

    //     $editor_asset = $asset_config['js/editor.js'];
    // }
}