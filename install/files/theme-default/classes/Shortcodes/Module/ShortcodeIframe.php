<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeIframe extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'src' => '#',
            'width' => 650,
            'height' => 400
        ), $atts));
        return '<iframe width="' . $width . '" height="' . $height . '" src="' . $src . '" frameborder="0" allowfullscreen></iframe>';
    }

}