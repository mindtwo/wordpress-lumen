<?php

/**
 * Entfernt Im backend Einträge aus der Menüleiste
 * Mögliche Werte: __('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins')
 */
function remove_wordpress_backend_menu_li() {
	global $menu;
	$restricted = array( __( 'Comments' ), __( 'Links' ) );
	end( $menu );
	while ( prev( $menu ) ) {
		$value = explode( ' ', $menu[ key( $menu ) ][0] );
		if ( in_array( $value[0] != null ? $value[0] : "", $restricted ) ) {
			unset( $menu[ key( $menu ) ] );
		}
	}
}
add_action( 'admin_menu', 'remove_wordpress_backend_menu_li' );


/**
 * Remove standard widgets
 */
function my_unregister_widgets() {
	//unregister_widget( 'WP_Widget_Pages' );
	unregister_widget( 'WP_Widget_Calendar' );
	//unregister_widget( 'WP_Widget_Archives' );
	//unregister_widget( 'WP_Widget_Links' );
	//unregister_widget( 'WP_Widget_Categories' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Search' );
	//unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Widget_Meta' );
	unregister_widget( 'WP_Widget_Recent_Comments' );
	unregister_widget( 'WP_Widget_RSS' );
	// unregister_widget( 'WP_Widget_Text' );
}
add_action( 'widgets_init', 'my_unregister_widgets' );


/*
 * Remove unused links in admin bar
 */
function remove_admin_bar_links() {
	global $wp_admin_bar;
	//$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
	//$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
	//$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
	//$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
	$wp_admin_bar->remove_menu( 'support-forums' );   // Remove the support forums link
	$wp_admin_bar->remove_menu( 'feedback' );         // Remove the feedback link
	//$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
	//$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
	//$wp_admin_bar->remove_menu('updates');          // Remove the updates link
	$wp_admin_bar->remove_menu( 'comments' );         // Remove the comments link
	//$wp_admin_bar->remove_menu('new-content');      // Remove the content link
	//$wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
	//$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


/*
 * Custom ACF Backend CSS
 */
function my_acf_admin_head() {
	echo '<style type="text/css">.acf_postbox .field textarea{min-height:0;}</style>';
}
add_action( 'acf/input/admin_head', 'my_acf_admin_head' );


/*
 * Modifying TinyMCE editor to remove unused items.
 */
function mce_mod( $init ) {
	$init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6';
	return $init;
}
add_filter( 'tiny_mce_before_init', 'mce_mod' );