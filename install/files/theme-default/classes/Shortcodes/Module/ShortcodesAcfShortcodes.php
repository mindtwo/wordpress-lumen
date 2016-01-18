<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodesAcfOptions extends ShortcodeModule {

    public $option_fields;

    /**
     * Register WordPress shortcodes
     */
    public function register() {
        if( function_exists( 'add_filter' ) ) {
            add_filter('init', [$this, 'add_acf_shortcodes']);
        }
    }

    /**
     * Sample SCF Shortcode
     *
     * @return string
     */
    public function acf_shortcode_sample() {
        // return '';
    }

    /**
     * Add custom ACF shortcodes
     */
    public function add_acf_shortcodes() {
        if(function_exists('has_sub_field')) {
            while ( has_sub_field( 'acf_shortcode', 'option' ) ):
                $key            = get_sub_field( 'key' );
                $shortcode_type = get_row_layout();
                if ( function_exists( 'acf_shortcode_' . $shortcode_type ) ) {
                    add_shortcode( $key, [$this, 'acf_shortcode_' . $shortcode_type]);
                }
            endwhile;
        }
    }

    /**
     * ACF Shortcode option field loader
     */
    public function acf_shortcode_load_option_subfield( $shortcode_key, $fields ) {
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