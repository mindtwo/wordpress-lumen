<?php

namespace WpTheme\Modules\WpCleanup;

class FrontendRegister {

    /**
     * Initialize
     */
    public function __construct() {
        add_action( 'init', [$this, 'remove_head_links'] );
        add_action( 'init', [$this, 'remove_admin_bar'] );
        add_action( 'init', [$this, 'add_post_formats'] );
        add_action( 'init', [$this, 'add_theme_support'] );
        add_action( 'wp_enqueue_scripts', [$this, 'cleanup_scripts'] );

    }

    public function remove_admin_bar() {
        /**
         * Remove Adminbar from Frontend
         */
        if ( function_exists( 'show_admin_bar' ) ) {
            show_admin_bar( false );
        }
    }

    /**
     * Deregister scripts
     */
    public function cleanup_scripts ()
    {
        if ( function_exists( 'is_admin' ) && !is_admin () ) {
            wp_deregister_script ( 'wp-embed' );
        }
    }


    /**
     * Clean <head> Section
     */
    public function remove_head_links() {
        if ( function_exists( 'remove_action' ) ) {
            remove_action( 'wp_head', 'rsd_link' );
            remove_action( 'wp_head', 'wlwmanifest_link' );
            remove_action( 'wp_head', 'wp_generator' );
            remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
            remove_action( 'wp_head', 'index_rel_link' );
            remove_action( 'wp_head', 'feed_links_extra' );
            remove_action( 'wp_head', 'feed_links_extra', 3 );
            remove_action( 'wp_head', 'feed_links' );
            remove_action( 'wp_head', 'feed_links', 2 );
            remove_action( 'wp_head', 'parent_post_rel_link' );
            remove_action( 'wp_head', 'start_post_rel_link' );
            remove_action( 'wp_head', 'adjacent_posts_rel_link' );
            remove_action( 'wp_head', 'wp_shortlink_wp_head' );
            remove_action( 'wp_head', 'rest_output_link_wp_head' );
            remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );
        }
    }

    /**
     * Add HTML5 Support
     */
    public function add_post_formats() {
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'post-formats', array(
                'aside',
                'gallery',
                'link',
                'image',
                'quote',
                'status',
                'audio',
                'chat',
                'video'
            ) );
        }

    }

    /**
     * Add support for WP 3.0 features, thumbnails etc
     */
    public function add_theme_support() {
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'post-thumbnails' );
            add_theme_support( 'menus' );
            add_theme_support( 'automatic-feed-links' );
        }
    }

}