<?php

namespace WpTheme\Modules;

use Illuminate\Cache\CacheManager;
use Illuminate\Support\ServiceProvider;
use Jenssegers\Agent\Agent;
use WpTheme\Modules\Addon\AddonACF;
use WpTheme\Modules\Addon\WordPressTotalCache;

class ModulesRegister extends ServiceProvider
{

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
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->types as $type) {
            $this->app->make($type);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('AddonACF', function ($app) {
            return new AddonACF(
                new CacheManager($this->app)
            );
        });

        $this->app->singleton('WordPressTotalCache', function ($app) {
            return new WordPressTotalCache(
                new CacheManager($this->app)
            );
        });

        $this->app->singleton('Agent', Agent::class);

        foreach ($this->types as $type) {
            $this->app->singleton($type, $type);
        }
    }
}