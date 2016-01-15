<?php

namespace WpTheme\Widgets;


class WidgetsRegister {

    /**
     * @var array
     */
    public $widgets = [
        \WpTheme\Widgets\Widget\WidgetCustomSearch::class,
    ];

    /**
     * Add register widget hook
     */
    public function __construct() {
        add_action( 'widgets_init', array( $this, 'register' ) );
    }

    /**
     * Register widgets
     */
    public function register() {
        foreach($this->widgets as $widget) {
            register_widget(new $widget);
        }
    }

}