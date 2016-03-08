<?php

namespace WpTheme\Modules\Ajax\Requests;

class BackendConversionHtml {

    /**
     * GlobalAjaxActions constructor.
     */
    public function __construct() {

        // Register ajax handlers
        add_action( 'wp_ajax_conversion_html', array( $this, 'ajax_load_conversion_html' ) );

    }

    /**
     * Ajax action to load conversion html
     */
    public function ajax_load_conversion_html() {
        if(! isset($_REQUEST) || ! array_key_exists('nonce', $_REQUEST) || ! wp_verify_nonce( $_REQUEST['nonce'], 'conversion_html' )) {
            die( 'Security check failed!' );
        }

        $response = '';

        if(isset($_REQUEST) && array_key_exists('conversion_id', $_REQUEST)) {
            $response = get_field('mail_html', $_REQUEST['conversion_id'], false);
        }

        $response = $this->replace_embedded_logo( $response );

        header( "Content-Type: text/html" );
        echo $response;
        exit;
    }

    /**
     * @param $response
     *
     * @return mixed
     */
    protected function replace_embedded_logo( $response ) {
        $logo = get_field( 'logo_image_svg_filename', 'options' );
        if ( $logo ) {
            $logo     = theme_images_path( true ) . $logo;
            $response = str_replace( 'cid:logo', $logo, $response );
            return $response;
        }

        return $response;
    }
}