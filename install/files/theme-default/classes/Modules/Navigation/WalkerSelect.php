<?php

namespace WpTheme\Modules\Navigation;

use Walker_Nav_Menu;

/**
 * Nav Menu Dropdown
 *
 * Walker Class for selecting only current nav children.
 * Modified version of Stephen Harris class that adds in support for selecting based on menu_item_id
 *
 * @param int $menu_item_id ID of the menu item you want to select off of (optional)
 *
 * @author Jake Chamberlain
 * @link http://jchamb.com
 * @author Stephen Harris
 * @link http://wp.tutsplus.com/tutorials/creative-coding/understanding-the-walker-class/
 */

class WalkerSelect extends Walker_Nav_Menu {
    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth Depth of page. Used for padding.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat( "\t", $depth );
        $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu list-inline\">\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int    $depth Depth of menu item. Used for padding.
     * @param int    $current_page Menu item ID.
     * @param object $args
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        /**
         * Dividers, Headers or Disabled
         * =============================
         * Determine whether the item is a Divider, Header, Disabled or regular
         * menu item. To prevent errors we use the strcasecmp() function to so a
         * comparison that is not case sensitive. The strcasecmp() function returns
         * a 0 if the strings are equal.
         */
        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
        } else if ( strcasecmp( $item->title, 'divider' ) == 0 && $depth === 1 ) {
        } else if ( strcasecmp( $item->attr_title, 'dropdown-header' ) == 0 && $depth === 1 ) {
        } else if ( strcasecmp( $item->attr_title, 'disabled' ) == 0 ) {
        } else {
            $class_names = $value = '';
            $classes     = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[]   = 'menu-item-' . $item->ID;
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            if ( in_array( 'current-menu-item', $classes ) && ! strrpos( $item->url, "#" ) ) {
                $class_names .= ' active';
            }
            $value = ! empty( $item->url ) ? ' value="' . $item->url . '" ' : '';
            $title  = ! empty( $item->title ) ? $item->title : '';
            $item_output = $args->before;
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
            $id          = $id ? ' id="' . esc_attr( $id ) . '"' : '';
            $output .= $indent . '<option' . $value . $class_names . '>';
            $output .= $title;

            $item_output .= $args->after;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    // replace closing </li> with the closing option tag
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</option>\n";
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array  $children_elements List of elements to continue traversing.
     * @param int    $max_depth Max depth to traverse.
     * @param int    $depth Depth of current element.
     * @param array  $args
     * @param string $output Passed by reference. Used to append additional content.
     *
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        // Display this element.
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
        }
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback( $args ) {
        if ( current_user_can( 'manage_options' ) ) {
            extract( $args );
            $fb_output = null;
            if ( $container ) {
                $fb_output = '<' . $container;
                if ( $container_id ) {
                    $fb_output .= ' id="' . $container_id . '"';
                }
                if ( $container_class ) {
                    $fb_output .= ' class="' . $container_class . '"';
                }
                $fb_output .= '>';
            }
            $fb_output .= '<ul';
            if ( $menu_id ) {
                $fb_output .= ' id="' . $menu_id . '"';
            }
            if ( $menu_class ) {
                $fb_output .= ' class="' . $menu_class . '"';
            }
            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
            $fb_output .= '</ul>';
            if ( $container ) {
                $fb_output .= '</' . $container . '>';
            }
            echo $fb_output;
        }
    }
}