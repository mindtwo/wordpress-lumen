<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeHr extends ShortcodeModule
{

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle($atts, $content = null)
    {
        return $this->render_view('partials/hr.php.twig');
    }

}