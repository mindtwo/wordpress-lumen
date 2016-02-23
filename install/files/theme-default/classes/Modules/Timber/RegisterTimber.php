<?php

namespace WpTheme\Modules\Timber;

use Timber;

class RegisterTimber {

    /**
     * Initialize
     */
    public function __construct() {
        if (class_exists('\Timber')) {
            Timber::$locations = TEMPLATE_DIR;
            Timber::$dirname   = TEMPLATE_DIR;
            // Timber::$cache     = true;
        }
        add_filter( 'timber_context', [$this, 'timber_context'] );
    }

    function timber_context( $context ) {
        $context['options'] = app('ACF')->get_option_fields();
        $context['selected_location'] = app('ACF')->get_selected_location();
        return $context;
    }

}

