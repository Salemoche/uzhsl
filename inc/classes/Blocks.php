<?php

/**
 * Register Block Classes
 * 
 * @package UZHSL
 */

namespace UZHSLNamespace\classes;

use UZHSLNamespace\traits\Singleton;

class Blocks {
    use Singleton;

    function __construct() {

        add_action('block_categories', [$this, 'add_block_categories']);
        add_action('acf/init', [$this, 'register_block']);
    }


    public function add_block_categories ( $categories ) {
        
        $category_slugs = wp_list_pluck( $categories, 'slug' );

        return in_array( 'uzhsl', $category_slugs, true) ? $categories : 
            array_merge ([
                    [
                        'slug' => 'uzhsl',
                        'title' => __( 'UZHSL Blocks', 'uzhsl' ),
                        'icon' => 'table-row-after'
                    ]
                ], 
                $categories
            );
    }

    public function register_block () {
        if( function_exists('acf_register_block_type') ) {

            acf_register_block_type(array(
                'name'              => 'standard_block',
                'title'             => __('Standard Block'),
                'description'       => __('The standard 5 – 1 – 6 Block'),
                'render_template'   => UZHSL_BLOCK_TEMPLATE_DIR . '/standard_block.php',
                'category'          => 'uzhsl',
                'mode'              => 'auto',
                'align'             => 'full',
                'icon'              => 'dashicons-welcome-widgets-menus',
                'keywords'          => array( 'block'),
                // 'enqueue_assets'    => [ $this, 'enqueue_assets' ],
            ));

            acf_register_block_type(array(
                'name'              => 'news_block',
                'title'             => __('News Block'),
                'description'       => __('The News Block'),
                'render_template'   => UZHSL_BLOCK_TEMPLATE_DIR . '/news_block.php',
                'category'          => 'uzhsl',
                'mode'              => 'auto',
                'align'             => 'full',
                'icon'              => 'dashicons-welcome-widgets-menus',
                'keywords'          => array( 'block'),
                // 'enqueue_assets'    => [ $this, 'enqueue_assets' ],
            ));

            acf_register_block_type(array(
                'name'              => 'publication_slider_block',
                'title'             => __('Publication Slider Block'),
                'description'       => __('Selection of Publications'),
                'render_template'   => UZHSL_BLOCK_TEMPLATE_DIR . '/publication_slider_block.php',
                'category'          => 'uzhsl',
                'mode'              => 'auto',
                'align'             => 'full',
                'icon'              => 'dashicons-welcome-widgets-menus',
                'keywords'          => array( 'block'),
                // 'enqueue_assets'    => [ $this, 'enqueue_assets' ],
            ));
        }
    }

    public function enqueue_assets () {
        // wp_enqueue_script( 'block-testimonial', SALEMOCHE_ESSENTIALS_JS_URL . '/main.js', ['jquery'], false, true );
        // wp_enqueue_style( 'block-testimonial', SALEMOCHE_ESSENTIALS_CSS_URL . '/main.css');
    }
}