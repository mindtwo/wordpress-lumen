<?php

namespace WpTheme\Modules\Timber;

use Timber\Timber as TimberLib;


class RegisterTimber
{

    /**
     * Initialize
     */
    public function __construct()
    {
        if (class_exists('\Timber\Timber')) {
            TimberLib::$locations = TEMPLATE_DIR;
            TimberLib::$dirname = TEMPLATE_DIR;
            // Timber::$cache     = true;
        }
        add_filter('timber_context', [$this, 'timber_context']);
    }

    function timber_context($context)
    {
        $context['options'] = app('AddonACF')->get_option_fields();
        return $context;
    }
}