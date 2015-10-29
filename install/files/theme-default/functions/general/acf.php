<?php

/**
 * ACF init
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();


	/**
	 * Ads multiple sub sections
	 */
	if ( function_exists( 'acf_add_options_sub_page' ) ) {
		acf_add_options_sub_page( 'Default' );
	}


	/**
	 * @param $path
	 *
	 * @return string
	 */
	function my_acf_json_save_point( $path ) {

		// update path
		$path = get_stylesheet_directory() . '/acf-json';


		// return
		return $path;

	}

	add_filter('acf/settings/save_json', 'my_acf_json_save_point');

	/**
	 * ACF Shortcode option field loader
	 */
	function acf_shortcode_load_option_subfield( $shortcode_key, $fields ) {
		$options = get_field_object( 'acf_shortcode', 'option' );
		if ( isset( $options['value'] ) ) {
			foreach ( $options['value'] as $key => $option ) {
				if ( isset( $option['key'] ) && $option['key'] == $shortcode_key ) {
					$result = array();
					foreach ( $fields as $field ) {
						if ( isset( $option[ $field ] ) ) {
							$result[ $field ] = $option[ $field ];
						}
					}

					return $result;
				}
			}
		}
	}


	/**
	 * Get conversion codes from ACF option page
	 */
	function trackingCode( $get_by_key ) {
		while ( has_sub_field( 'conversion_codes', 'option' ) ):
			$key    = get_sub_field( 'key' );
			$markup = get_sub_field( 'value' );
			if ( $get_by_key == $key ) {
				return $markup;
			}
		endwhile;
	}


	/**
	 * Add custom ACF shortcodes
	 */
	while ( has_sub_field( 'acf_shortcode', 'option' ) ):
		$key            = get_sub_field( 'key' );
		$shortcode_type = get_row_layout();
		if ( function_exists( 'acf_shortcode_' . $shortcode_type ) ) {
			add_shortcode( $key, 'acf_shortcode_' . $shortcode_type );
		}
	endwhile;
}


