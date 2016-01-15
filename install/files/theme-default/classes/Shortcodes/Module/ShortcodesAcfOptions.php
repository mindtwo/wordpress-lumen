<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodesAcfOptions extends ShortcodeModule {

    public $option_fields;

    /**
     * Register WordPress shortcodes
     */
    public function register() {
        // Load all option fields at once
        if(function_exists('get_fields')) {
            $this->option_fields = get_fields( 'option' );
        }

        $register_shortcodes = array(
            'get_mobile_phone_number_display' => 'get_mobile_phone_number_display',
            'get_mobile_phone_number_href'    => 'get_mobile_phone_number_href',
            'get_country'                     => 'get_country',
            'get_linkedin'                    => 'get_linkedin',
            'get_facebook'                    => 'get_facebook',
            'get_xing'                        => 'get_xing',
            'get_twitter'                     => 'get_twitter',
            'get_google_plus'                 => 'get_google_plus',
            'get_pinterest'                   => 'get_pinterest',
            'get_instagram'                   => 'get_instagram',
            'get_ceo'                         => 'get_ceo',
            'get_trade_register'              => 'get_trade_register',
            'get_turnover_tax_id'             => 'get_turnover_tax_id',
            'get_local_court'                 => 'get_local_court',
            'get_company_name'                => 'get_company_name',
            'get_street'                      => 'get_street',
            'get_zip'                         => 'get_zip',
            'get_city'                        => 'get_city',
            'get_phone_number_display'        => 'get_phone_number_display',
            'get_phone_number_display'        => 'get_phone_number_href',
            'get_fax'                         => 'get_fax',
            'get_google_analytics_id'         => 'get_google_analytics_id',
            'get_footer_tracking_codes'       => 'get_footer_tracking_codes',
            'get_header_tracking_codes'       => 'get_header_tracking_codes',
            'get_email'                       => 'shortcode_email',
        );

        // Loop given shortcodes and add them to WordPress
        foreach ( $register_shortcodes as $key => $value ) {
            add_shortcode( $key, array( $this , $value ) );
        }
    }

    /**
     * Check if ACF options is available as fallback
     *
     * @param $pram
     * @param $value
     *
     * @return mixed
     */
    public function __call( $pram, $value ) {
        if ( isset( $this->option_fields[ str_replace( 'get_', '', $pram ) ] ) ) {
            return $this->option_fields[ str_replace( 'get_', '', $pram ) ];
        }

        return '';
    }

    /**
     * Character encode email address
     *
     * @return string
     */
    public function shortcode_email() {
        return encode_all_htmlentities( $this->option_fields['email'] );
    }
}