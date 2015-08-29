<?php

/**
 * Shortcodes im textwidget erlauben
 */
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );


/**
 * Clean up Shortcode Content
 */
function parse_shortcode_content( $content ) {
	// Parse nested shortcodes and add formatting.
	$content = trim( do_shortcode( shortcode_unautop( $content ) ) );

	// Remove '' from the start of the string.
	if ( substr( $content, 0, 4 ) == '' ) {
		$content = substr( $content, 4 );
	}

	// Remove '' from the end of the string.
	if ( substr( $content, - 3, 3 ) == '' ) {
		$content = substr( $content, 0, - 3 );
	}

	// Remove any instances of ''.
	$content = str_replace( array( '<p></p>' ), '', $content );
	$content = str_replace( array( '<p> </p>' ), '', $content );

	return $content;
}


/**
 * Move wpautop filter to AFTER shortcode is processed
 */
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop', 99 );
add_filter( 'the_content', 'shortcode_unautop', 100 );


/**
 * The same as above, but for acf
 */
remove_filter( 'acf_the_content', 'wpautop' );
add_filter( 'acf_the_content', 'wpautop', 99 );
add_filter( 'acf_the_content', 'shortcode_unautop', 100 );