<?php
/**
 * ========================================
 * 
 * Bootstrap the UZHSL Theme
 * 
 * @package UZHSL
 * 
 * ========================================
 */

namespace UZHSLNamespace\classes;

use UZHSLNamespace\traits\Singleton;

class Theme {
    use Singleton;

    protected function __construct() {
        // load class

        Assets::get_instance();
        Menus::get_instance();
        Blocks::get_instance();
    
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        // actions and filters

        add_action( 'after_setup_theme', [ $this, 'setup_theme' ] );
        add_action( 'init', [ $this, 'add_post_types' ] );
    }

    public function setup_theme() {

/**================
 * Theme Support
 ================*/

        add_theme_support( 'title-tag' );

        // add_theme_support( 'custom-logo', [
        //     'header-text'   => ['site-title', 'site-description'],
        //     'height'        => 100,
        //     'width'         => 400,
        //     'flex-height'   => true,
        //     'flex-width'    => true
        // ] );

        add_theme_support( 'post-thumbnails' ); 

        add_image_size( 'featured-thumbnail', 350, 233, true); // get this size from the inspector to see how big the image should be

        add_theme_support( 'customize-selective-refresh-widgets' );

        add_theme_support( 'automatic-feed-links' );

        add_theme_support( 
            'html5', 
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style'
            ]
        );

        add_theme_support( 'wp-block-style' );

        add_theme_support( 'align-wide' );

        add_theme_support( 'editor-styles' );
        add_editor_style( 'assets/build/css/editor.css' );

        $this->add_options_page();

        global $content_width;
        if ( !isset( $content_width ) ) {
            $content_width = 1240;
        }


/**================
 * Custom Menu 
================*/

        add_filter('custom_menu_order', '__return_true');
        add_filter('menu_order', [$this, 'custom_menu_order']);

        add_action( 'admin_menu', [$this, 'control_admin_access']);


/**================
 * Data handling
================*/
        add_filter('upload_mimes', function($mimes) {
            $mimes['svg'] = 'image/svg+xml';
            return $mimes;
        });
    }


    /**================
     * Post Types
    ================*/
    
        public function add_post_types() {
    
            register_post_type('publication',
                array(
                    'labels'      => array(
                        'name'          => __('Publications', 'uzhsl'),
                        'singular_name' => __('Publication', 'uzhsl'),
                    ),
                    'public'      => true,
                    'has_archive' => true,
                    'menu_position' => -3,
                    'menu_icon' => 'dashicons-welcome-write-blog',
                    'supports' => [
                        'custom-fields',
                        'page-attributes',
                        'post-formats', 
                        'title',
                        'thumbnail',
                        'editor',
                        'excerpt'
                    ],
                    'taxonomies' => [
                        'category',
                    ],
                    'show_in_rest' => true,
                )
            );
    
            register_post_type('project',
                array(
                    'labels'      => array(
                        'name'          => __('Research', 'uzhsl'),
                        'singular_name' => __('Research', 'uzhsl'),
                    ),
                    'public'      => true,
                    'has_archive' => false,
                    'menu_position' => -3,
                    'menu_icon' => 'dashicons-search',
                    'supports' => [
                        'custom-fields',
                        'page-attributes',
                        'post-formats', 
                        'title',
                        'thumbnail',
                        'editor',
                        'excerpt',
                        'categories'
                    ],
                    'taxonomies' => [
                        'category',
                    ],
                    'show_in_rest' => true,
                )
            );
                    
            // register_post_type('team',
            //     array(
            //         'labels'      => array(
            //             'name'          => __('Team Member', 'uzhsl'),
            //             'singular_name' => __('Team Member', 'uzhsl'),
            //         ),
            //         'public'      => true,
            //         'has_archive' => true,
            //         'menu_position' => -2,
            //         'menu_icon' => 'dashicons-admin-users',
            //         // 'show_in_rest' => true,
            //         'supports' => [
            //             'custom-fields',
            //             'page-attributes',
            //             'post-formats', 
            //             'title',
            //             'thumbnail',
            //             'editor'
            //         ],
            //     )
            // );
                    
            register_post_type('teachings',
                array(
                    'labels'      => array(
                        'name'          => __('Teaching', 'uzhsl'),
                        'singular_name' => __('Teaching', 'uzhsl'),
                    ),
                    'public'      => true,
                    'has_archive' => true,
                    'menu_position' => -4,
                    'menu_icon' => 'dashicons-clipboard',
                    'supports' => [
                        'custom-fields',
                        'page-attributes',
                        'post-formats', 
                        'title',
                        'thumbnail',
                        'editor'
                    ],
                )
            );
        }

    public function add_options_page() {
        if( function_exists('acf_add_options_page') ) {
    
            acf_add_options_page([
                'page_title'    => 'Site Settings',
                'menu_title'    => 'Site Settings',
                'menu_slug'    => 'site-settings',
                'menu_order'         => '-100'
            ]);
            
        }
    }

    public function custom_menu_order($menu_order) {
        return array( 
            'index.php',
            'ai1wm_export', 
            'site-settings',
            'edit.php?post_type=page',
            'edit.php', 
            'edit-comments.php'
        );
    }

    public function control_admin_access() {
        // if (!current_user_can( 'manage_options' )) {
        //     remove_menu_page( 'index.php' );
        // }
    }

    public function mime_types($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }
}