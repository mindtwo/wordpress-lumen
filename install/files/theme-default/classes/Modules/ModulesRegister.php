<?php

namespace WpTheme\Modules;

class ModulesRegister {

    /**
     * @var array
     */
    public $types = [
        \WpTheme\Modules\Ajax\AjaxRegister::class,
        \WpTheme\Modules\Navigation\BootstrapWalker::class,
        \WpTheme\Modules\Navigation\MenuRegister::class,
        \WpTheme\Modules\Sidebar\SidebarRegister::class,
        \WpTheme\Modules\Media\ImageSizesRegister::class,
        \WpTheme\Modules\WpCleanup\BackendRegister::class,
        \WpTheme\Modules\WpCleanup\FrontendRegister::class,
        \WpTheme\Modules\WpCleanup\CustomExcerpt::class,
        \WpTheme\Modules\Addon\AddonACF::class,
        \WpTheme\Modules\Addon\AddonTimber::class,
        \WpTheme\Modules\Dashboard\Shortcode\ShortcodeDashboardRegister::class,
    ];

    /**
     * Register modules
     */
    public function __construct() {
        foreach($this->types as $type) {
            new $type;
        }
    }

}