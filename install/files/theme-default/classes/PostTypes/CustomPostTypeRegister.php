<?php

namespace WpTheme\PostTypes;

use Illuminate\Support\ServiceProvider;

class CustomPostTypeRegister extends ServiceProvider {

    /**
     * @var array
     */
    public $custom_post_types = [
        \WpTheme\PostTypes\Type\Post::class,
        \WpTheme\PostTypes\Type\Testimonial::class,
        \WpTheme\PostTypes\Type\Conversion::class,
        \WpTheme\PostTypes\Type\Faq::class,
        \WpTheme\PostTypes\Type\Job::class,
        \WpTheme\PostTypes\Type\Lexicon::class,
        \WpTheme\PostTypes\Type\Team::class,
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot() {
        foreach($this->custom_post_types as $type) {
            $this->app->make($type);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        foreach($this->custom_post_types as $type) {
            $this->app->singleton($type, $type);
        }
    }
}