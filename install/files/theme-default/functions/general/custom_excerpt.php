<?php

/**
 * Change […] to … in the_excerpt()
 */
function remove_ellipsis_brackets( $more ) {
	global $post;
	return;
}
add_filter( 'excerpt_more', 'remove_ellipsis_brackets' );


/**
 * Change the_excerpt() lenght
 */
function custom_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/**
 * Remove shortcodes from excerpt and excerpt-RSS
 */
function remove_shortcodes( $content ) {
	$content = strip_shortcodes( $content );
	return $content;
}
add_filter( 'the_excerpt', 'remove_shortcodes' );