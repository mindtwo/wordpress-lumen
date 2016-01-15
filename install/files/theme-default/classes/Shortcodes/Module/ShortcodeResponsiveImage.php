<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeResponsiveImage extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'image'            => '#',
            'responsive_image' => '',
            'alt'              => '',
            'image_class'      => '',
        ), $atts ) );

        // TODO: Load and return template
        // return $template;
    }

}