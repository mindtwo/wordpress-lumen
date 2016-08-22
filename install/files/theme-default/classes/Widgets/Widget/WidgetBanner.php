<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetBanner extends WidgetModule
{

    /**
     * @return mixed
     */
    public function register()
    {
        // Basics
        $this->widget_name = 'Banner';
        $this->widget_description = '';

        // Widget Fields
        $this->add_field('image_link');
        $this->add_field('image_alt');
        $this->add_field('link');
    }

    /** @see WP_Widget::widget */
    public function widget($args, $instance)
    {
        echo (array_key_exists('image_link', $instance)) ? $this->render_view('partials/widget-banner.html.twig', compact('instance')) : '';
    }
}