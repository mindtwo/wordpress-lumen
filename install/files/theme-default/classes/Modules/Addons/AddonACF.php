<?php

namespace WpTheme\Modules\Addon;

class AddonACF {
    /**
     * Initialize
     */
    public function __construct() {
        if ( function_exists( 'acf_add_options_page' ) ) {
            acf_add_options_page();
        }

        /**
         * Ads multiple sub sections
         */
        if ( function_exists( 'acf_add_options_sub_page' ) ) {
            acf_add_options_sub_page( 'Default' );
        }

        add_filter('init', [$this, 'add_acf_shortcodes']);
        add_filter('acf/settings/save_json', [$this, 'my_acf_json_save_point']);

    }

    /**
     * Add custom ACF shortcodes
     */
    public function add_acf_shortcodes() {
        while ( has_sub_field( 'acf_shortcode', 'option' ) ):
            $key            = get_sub_field( 'key' );
            $shortcode_type = get_row_layout();
            if ( function_exists( 'acf_shortcode_' . $shortcode_type ) ) {
                add_shortcode( $key, 'acf_shortcode_' . $shortcode_type );
            }
        endwhile;
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
}