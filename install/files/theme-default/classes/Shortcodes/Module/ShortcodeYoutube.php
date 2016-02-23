<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeYoutube extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'id' => '',
            'height' => '375',
            'width' => '100%',
            'theme' => 'dark',
            'controls' => '1',
        ), $atts ) );

        return do_shortcode("[iframe src='https://www.youtube-nocookie.com/embed/$id?rel=0&amp;controls=$controls&amp;showinfo=0&amp;title=0&amp;byline=0&amp;theme=$theme' height='$height' width='$width']");
    }
}