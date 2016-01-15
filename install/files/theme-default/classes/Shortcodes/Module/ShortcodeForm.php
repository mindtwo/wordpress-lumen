<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeForm extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'name' => 'contact',
            'wrap_before' => '',
            'wrap_after'  => ''
        ), $atts ) );

        // Load and return template
        return $this->render_view( "forms/$name-form.php.twig" );
    }

}