the same as above, but for acf<?php

/**
 * Custom navigation
 */
add_action( 'init', 'my_custom_menus' );
function my_custom_menus() {
	register_nav_menus(
		array(
			'menu-main'   => 'Main',
			'menu-footer' => 'Footer'
		)
	);
}


/**
 * current_page_parent for Custom Post Type
 */
function remove_parent_classes( $class ) {
	// check for current page classes, return false if they exist.
	return ( $class == 'current_page_item' || $class == 'current_page_parent' || $class == 'current_page_ancestor' || $class == 'current-menu-item' ) ? false : true;
}

function add_class_to_wp_nav_menu( $classes ) {
	switch ( get_post_type() ) {
		case 'POST_TYPE_NAME' :
			// we're viewing a custom post type, so remove the 'current_page_xxx and current-menu-item' from all menu items.
			$classes = array_filter( $classes, "remove_parent_classes" );

			// add the current page class to a specific menu item (replace ###).
			if ( in_array( 'menu-item-38', $classes ) ) {
				$classes[] = 'current_page_parent';
			}
			break;
		// add more cases if necessary and/or a default
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'add_class_to_wp_nav_menu' );


/**
 * Setzt die Last und First CSS Klasse für das wp_nav_menu
 */
function add_first_and_last( $output ) {
	$output = preg_replace( '/class="menu-item/', 'class="first menu-item', $output, 1 );
	$output = substr_replace( $output, 'class="last menu-item', strripos( $output, 'class="menu-item' ), strlen( 'class="menu-item' ) );

	return $output;
}

add_filter( 'wp_nav_menu', 'add_first_and_last' );