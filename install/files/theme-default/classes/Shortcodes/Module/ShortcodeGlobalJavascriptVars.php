<?php

namespace WpTheme\Shortcodes\Module;

use WpTheme\Shortcodes\ShortcodeModule;

class ShortcodeGlobalJavascriptVars extends ShortcodeModule
{

    /**
     * @param $atts
     *
     * @return mixed
     */
    public function handle($atts, $content = null)
    {
        return sprintf('<script type="text/javascript">var GlobalVars=%s;</script>', collect([
            // URL to wp-admin/admin-ajax.php to process the request
            'ajax_url' => admin_url('admin-ajax.php'),

            // Set api keys
            'google_maps_public_api_key' => config('services.google.maps.public_api_key'),
            'google_recaptcha_public_api_key' => config('services.google.recaptcha.public_api_key'),

            // Submit server vars
            'http_host' => collect($_SERVER)->get('HTTP_HOST'),

            // Submit responsive vars
            'svg_ready' => svg_ready(),
            'is_mobile' => is_mobile(),
            'is_tablet' => is_tablet(),
            'is_desktop' => (!is_tablet() && !is_mobile()),

            // Site specific
            'blog_id' => get_current_blog_id(),
        ])->toJson());
    }
}