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
         * Adds multiple sub sections
         */
        if ( function_exists( 'acf_add_options_sub_page' ) ) {
            acf_add_options_sub_page( 'Default' );
        }

        if( function_exists( 'add_filter' ) ) {
            add_filter('acf/settings/save_json', [$this, 'my_acf_json_save_point']);
        }
    }

    /**
     * @param $path
     *
     * @return string
     */
    function my_acf_json_save_point( $path ) {
        return get_stylesheet_directory() . '/acf-json';
    }
}