<?php

namespace WpTheme\PostTypes;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class PostTypeRepositoryRegister extends ServiceProvider {

    /**
     * @var array
     */
    public $custom_post_types = [
        // \WpTheme\PostTypes\Repository\Post::class,
        // \WpTheme\PostTypes\Repository\Page::class,
        // \WpTheme\PostTypes\Repository\Testimonial::class,
        \WpTheme\PostTypes\Repository\Conversion::class,
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        foreach($this->custom_post_types as $type) {
            $this->app->singleton($type, function ($type) {
                return new $type;
            });
            new $type;
        }
    }
}