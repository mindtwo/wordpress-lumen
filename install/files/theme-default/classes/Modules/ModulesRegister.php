<?php

namespace WpTheme\Modules;

use Illuminate\Cache\CacheManager;
use Illuminate\Support\ServiceProvider;

class ModulesRegister extends ServiceProvider{

    protected $storage;

    /**
     * @var array
     */
    public $types = [
        \WpTheme\Modules\Ajax\AjaxRegister::class,
        \WpTheme\Modules\Navigation\MenuRegister::class,
        \WpTheme\Modules\Sidebar\SidebarRegister::class,
        \WpTheme\Modules\Media\ImageSizesRegister::class,
        \WpTheme\Modules\WpCleanup\BackendRegister::class,
        \WpTheme\Modules\WpCleanup\FrontendRegister::class,
        \WpTheme\Modules\WpCleanup\CustomExcerpt::class,
        \WpTheme\Modules\Timber\RegisterTimber::class,
        \WpTheme\Modules\Dashboard\Shortcode\ShortcodeDashboardRegister::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->singleton('ACF', function () {
            return new \WpTheme\Modules\Addon\AddonACF(
                new CacheManager($this->app)
            );
        });

        $this->app->singleton('Agent', function () {
            return new \Jenssegers\Agent\Agent();
        });

        foreach($this->types as $type) {
            new $type;
        }
    }
}