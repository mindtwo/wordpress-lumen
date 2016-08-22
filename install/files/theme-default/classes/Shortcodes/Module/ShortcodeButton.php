<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeButton extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'href'  => '#',
            'label' => '',
            'icon' => false,
            'class' => 'btn btn-primary',
        ), $atts ) );

        return $this->compress_output($this->render_view( 'partials/button.php.twig', [ 'icon' => $icon, 'href' => $href, 'label' => $label, 'class' => $class ] ));
    }

}