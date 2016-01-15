<?php

namespace WpTheme\Modules\WpCleanup;

class BackendRegister {

    /**
     * Initialize
     */
    public function __construct() {
        add_action( 'admin_menu', [$this, 'remove_wordpress_backend_menu_li'] );
        add_action( 'widgets_init', [$this, 'my_unregister_widgets'] );
        add_action( 'wp_before_admin_bar_render', [$this, 'remove_admin_bar_links'] );
        add_action( 'admin_bar_menu', [$this, 'remove_wp_nodes'], 999 );
        add_action( 'acf/input/admin_head', [$this, 'my_acf_admin_head'] );
        add_filter( 'tiny_mce_before_init', [$this, 'mce_mod'] );
        add_filter( 'tiny_mce_before_init', [$this, 'tinymce_paste_as_text'] );
        add_action( 'edit_form_after_title', [$this, 'fix_no_editor_on_posts_page'], 0 );
    }

    /**
     * Entfernt Im backend Einträge aus der Menüleiste
     * Mögliche Werte: __('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins')
     */
    public function remove_wordpress_backend_menu_li () {
        global $menu;
        $restricted = array ( __ ( 'Comments' ), __ ( 'Links' ) );
        end ( $menu );
        while ( prev ( $menu ) ) {
            $value = explode ( ' ', $menu[ key ( $menu ) ][0] );
            if ( in_array ( $value[0] != null ? $value[0] : "", $restricted ) ) {
                unset( $menu[ key ( $menu ) ] );
            }
        }
    }

    /**
     * Remove standard widgets
     */
    public function my_unregister_widgets () {
        //unregister_widget( 'WP_Widget_Pages' );
        unregister_widget ( 'WP_Widget_Calendar' );
        //unregister_widget( 'WP_Widget_Archives' );
        //unregister_widget( 'WP_Widget_Links' );
        //unregister_widget( 'WP_Widget_Categories' );
        unregister_widget ( 'WP_Widget_Recent_Posts' );
        unregister_widget ( 'WP_Widget_Search' );
        //unregister_widget( 'WP_Widget_Tag_Cloud' );
        unregister_widget ( 'WP_Widget_Meta' );
        unregister_widget ( 'WP_Widget_Recent_Comments' );
        unregister_widget ( 'WP_Widget_RSS' );
        // unregister_widget( 'WP_Widget_Text' );
    }

    /*
     * Remove unused links in admin bar
     */
    public function remove_admin_bar_links () {
        global $wp_admin_bar;
        //$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
        //$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
        //$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
        //$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
        $wp_admin_bar->remove_menu ( 'support-forums' );   // Remove the support forums link
        $wp_admin_bar->remove_menu ( 'feedback' );         // Remove the feedback link
        //$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
        //$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
        //$wp_admin_bar->remove_menu('updates');          // Remove the updates link
        $wp_admin_bar->remove_menu ( 'comments' );         // Remove the comments link
        //$wp_admin_bar->remove_menu('new-content');      // Remove the content link
        //$wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
        //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
    }

    /*
     * Remove nodes from admin bar item new-content
     */
    public function remove_wp_nodes () {
        global $wp_admin_bar;
        $wp_admin_bar->remove_node ( 'new-post' );
        $wp_admin_bar->remove_node ( 'new-link' );
        $wp_admin_bar->remove_node ( 'new-media' );
    }

    /*
     * Custom ACF Backend CSS
     */
    public function my_acf_admin_head () {
        echo '<style type="text/css">.acf_postbox .field textarea{min-height:0;}</style>';
    }

    /*
     * Modifying TinyMCE editor to remove unused items.
     */
    public function mce_mod ( $init ) {
        $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
        return $init;
    }

    /**
     * Paste as text by default
     */
    public function tinymce_paste_as_text ( $init ) {
        $init['paste_as_text'] = true;
        return $init;
    }

    /**
     * Add the wp-editor back into WordPress after it was removed in 4.2.2.
     *
     * @param Object $post
     * @return void
     */
    public function fix_no_editor_on_posts_page( $post ) {
        if( isset( $post ) && $post->ID != get_option('page_for_posts') ) {
            return;
        }

        remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );
        add_post_type_support( 'page', 'editor' );
    }
}