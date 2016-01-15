<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeBox extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        extract( shortcode_atts( array(
            'class' => false,
        ), $atts ) );

        return $this->render_view( 'partials/box.php.twig', [ 'content' => $content, 'class' => $class ] );
    }

}