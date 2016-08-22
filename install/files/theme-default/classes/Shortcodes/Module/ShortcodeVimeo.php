<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeVimeo extends ShortcodeModule
{

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'id' => '',
            'height' => '375',
            'width' => '100%',
        ), $atts));

        return do_shortcode("[iframe src='http://player.vimeo.com/video/$id?title=0&amp;byline=0' height='$height' width='$width']");
    }

}