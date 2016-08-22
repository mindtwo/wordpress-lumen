<?php

namespace WpTheme\Widgets;


use Illuminate\Support\ServiceProvider;

class WidgetsRegister extends ServiceProvider
{

    /**
     * @var array
     */
    public $widgets = [
        // \WpTheme\Widgets\Widget\WidgetCustomSearch::class,
        \WpTheme\Widgets\Widget\WidgetContactBox::class,
        \WpTheme\Widgets\Widget\WidgetSubnav::class,
        \WpTheme\Widgets\Widget\WidgetBox::class,
        \WpTheme\Widgets\Widget\WidgetLatestNews::class,
        \WpTheme\Widgets\Widget\WidgetBanner::class,
    ];

    /**
     * Register widgets
     */
    public function boot()
    {
        add_action('widgets_init', array($this, 'load_registred_widgets'));

        // Allow shortcodes in text widget
        add_filter('widget_text', 'shortcode_unautop');
        add_filter('widget_text', 'do_shortcode');

    }

    /**
     * Register widgets
     */
    public function register()
    {
        // Register shortcode singeltons
        foreach ($this->widgets as $widget) {
            $this->app->singleton($widget, $widget);
        }
    }

    /**
     *
     */
    public function load_registred_widgets()
    {
        global $wp_widget_factory;
        foreach ($this->widgets as $widget) {
            $wp_widget_factory->widgets[$widget] = $this->app->make($widget);
        }
    }

}