<?php

/**
 * Add HTML5 Support
 */
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


/**
 * Add support for WP 3.0 features, thumbnails etc
 */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
}

/**
 * Clean <head> Section
 */
function removeHeadLinks() {
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
	}
}
add_action( 'init', 'removeHeadLinks' );


/**
 * Remove Adminbar from Frontend
 */
if ( function_exists( 'show_admin_bar' ) ) {
	show_admin_bar( false );
}