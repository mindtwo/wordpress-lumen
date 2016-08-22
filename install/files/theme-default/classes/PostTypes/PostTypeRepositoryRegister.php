<?php

namespace WpTheme\PostTypes;

use Illuminate\Support\ServiceProvider;

class PostTypeRepositoryRegister extends ServiceProvider
{

    /**
     * @var array
     */
    public $custom_post_types = [
        \WpTheme\PostTypes\Repository\Post::class,
        \WpTheme\PostTypes\Repository\Page::class,
        \WpTheme\PostTypes\Repository\Testimonial::class,
        \WpTheme\PostTypes\Repository\Conversion::class,
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->custom_post_types as $type) {
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
        foreach ($this->custom_post_types as $type) {
            $this->app->singleton($type, $type);
        }
    }
}