<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeFontAwesome extends ShortcodeModule {

    /**
     * Register specific shortcode name
     */
    public function register() {
        add_shortcode( 'fa', array( $this , 'handle' ) );
    }

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'icon' => '',
        ), $atts ) );

        return '<i class="fa '.$icon.'"></i>';
    }

}