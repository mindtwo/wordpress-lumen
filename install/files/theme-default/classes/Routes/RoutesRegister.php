<?php

namespace WpTheme\Routes;

use Illuminate\Support\ServiceProvider;

class RoutesRegister extends ServiceProvider {

    /**
     * @var array
     */
    public $routes = [
        // \WpTheme\Routes\Directive\LocationPost::class,
    ];

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot() {
        foreach($this->routes as $route) {
            $this->app->make($route);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        foreach($this->routes as $route) {
            $this->app->singleton($route, $route);
        }
    }
}