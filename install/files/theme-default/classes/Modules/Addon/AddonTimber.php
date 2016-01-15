<?php

namespace WpTheme\Modules\Addon;

use Timber;

class AddonTimber {

    /**
     * Initialize
     */
    public function __construct() {
        if (class_exists('\Timber')) {
            Timber::$locations = TEMPLATE_DIR;
            Timber::$dirname   = TEMPLATE_DIR;
        }
        add_filter( 'timber_context', [$this, 'timber_context'] );
    }

    function timber_context( $context ) {
        $context['options'] = get_fields('option');
        return $context;
    }

}

