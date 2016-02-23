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
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        foreach($this->routes as $route) {
            new $route();
        }
    }
}