<?php

namespace WpTheme\Widgets;


use Illuminate\Support\ServiceProvider;

class WidgetsRegister extends ServiceProvider {

    /**
     * @var array
     */
    public $widgets = [
        // \WpTheme\Widgets\Widget\WidgetCustomSearch::class,
        \WpTheme\Widgets\Widget\WidgetContactBox::class,
        \WpTheme\Widgets\Widget\WidgetSubnav::class,
        \WpTheme\Widgets\Widget\WidgetLatestNews::class,
    ];


    /**
     * Register widgets
     */
    public function register() {
        add_action( 'widgets_init', array( $this, 'load_registred_widgets' ) );

        // Allow shortcodes in text widget
        add_filter( 'widget_text', 'shortcode_unautop' );
        add_filter( 'widget_text', 'do_shortcode' );

    }

    /**
     *
     */
    public function load_registred_widgets() {
        global $wp_widget_factory;
        foreach($this->widgets as $widget) {
            $wp_widget_factory->widgets[$widget] = new $widget($this->app);
        }
    }

}