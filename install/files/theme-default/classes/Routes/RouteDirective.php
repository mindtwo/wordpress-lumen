<?php

namespace WpTheme\Routes;

abstract class RouteDirective {

    /**
     * Route Directive constructor.
     */
    public function __construct() {
        $this->register();
    }

    /**
     * @return mixed
     */
    abstract public function handle();

    /**
     * Default register
     */
    public function register() {
        add_action( 'init', array( $this , 'handle' ) );
    }

    /**
     * @return mixed
     */
    protected function flush_rules() {
        global $wp_rewrite;
        return $wp_rewrite->flush_rules();
    }
}