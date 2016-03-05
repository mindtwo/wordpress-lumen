<?php

namespace WpTheme\Modules\Navigation;

class MenuRegister {

    /**
     * Initialize
     */
    public function __construct() {
        add_action( 'init', [ $this, 'custom_menus' ] );
        add_filter( 'nav_menu_css_class', [ $this, 'add_class_to_wp_nav_menu' ] );
        add_filter( 'wp_nav_menu', [ $this, 'add_first_and_last' ] );
    }

    /**
     * Register menu
     */
    public function custom_menus() {
        $menus = [
            'menu-main'   => 'Main',
            'menu-footer' => 'Footer',
        ];

        register_nav_menus( $menus );
    }

    /**
     * @param $class
     *
     * @return bool
     */
    protected function remove_parent_classes( $class ) {
        // check for current page classes, return false if they exist.
        return ( $class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor' || $class == 'current-menu-item' ) ? false : true;
    }

    /**
     * @param $classes
     *
     * @return array
     */
    public function add_class_to_wp_nav_menu( $classes ) {
        switch ( get_post_type() ) {
            case 'POST_TYPE_NAME' :
                // we're viewing a custom post type, so remove the 'current_page_xxx and current-menu-item' from all menu items.
                $classes = array_filter( $classes, [ $this, "remove_parent_classes" ] );

                // add the current page class to a specific menu item (replace ###).
                if ( in_array( 'menu-item-38', $classes ) ) {
                    $classes[] = 'current_page_parent';
                }
                break;
            // add more cases if necessary and/or a default
        }

        return $classes;
    }

    /**
     * @param $output
     *
     * @return mixed
     */
    public function add_first_and_last( $output ) {
        $output = preg_replace( '/class="menu-item/', 'class="first menu-item', $output, 1 );
        $output = substr_replace( $output, 'class="last menu-item', strripos( $output, 'class="menu-item' ), strlen( 'class="menu-item' ) );

        return $output;
    }
}