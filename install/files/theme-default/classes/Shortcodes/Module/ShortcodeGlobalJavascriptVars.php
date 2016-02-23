<?php

namespace WpTheme\Shortcodes\Module;

use Symfony\Component\HttpFoundation\Request;
use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeGlobalJavascriptVars extends ShortcodeModule {

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle( $atts, $content = null ) {
        $result = [
            // URL to wp-admin/admin-ajax.php to process the request
            'ajax_url' => admin_url( 'admin-ajax.php' ),

            // Set api keys
            'google_maps_public_api_key' => config('services.google.maps.public_api_key'),
            'google_recaptcha_public_api_key' => config('services.google.recaptcha.public_api_key'),

            // Submit server vars
            'http_host' => (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''),

            // Submit responsive vars
            'svg_ready' => svg_ready(),
            'is_mobile' => is_mobile(),
            'is_tablet' => is_tablet(),
            'is_desktop' => (!is_tablet() && !is_mobile()),

            // Site specific
            'blog_id' => get_current_blog_id(),
        ];

        return '<script type="text/javascript">var GlobalVars=' . json_encode($result) . ';</script>';
    }
}