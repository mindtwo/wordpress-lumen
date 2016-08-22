<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetBox extends WidgetModule
{

    /**
     * @return mixed
     */
    public function register()
    {
        // Basics
        $this->widget_name = 'Box';
        $this->widget_description = '';

        // Widget Fields
        $this->add_field('headline');
        $this->add_field('subline');
        $this->add_field('content', ['type' => 'textarea', 'title' => 'Inhalt']);
    }

    /** @see WP_Widget::widget */
    public function widget($args, $instance)
    {
        echo $this->render_view('partials/widget-box.html.twig', compact('instance'));
    }
}