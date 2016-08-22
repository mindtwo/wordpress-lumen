<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetSubnav extends WidgetModule
{

    /**
     * @return mixed
     */
    public function register()
    {
        // Basics
        $this->widget_name = 'Subnavigation Widget';
        $this->widget_description = '';

        // Widget Fields
        $this->add_field('child_of_shift', [
            'title' => 'Shift Menu Start',
            'type' => 'input_number',
        ]);

        $this->add_field('depth', [
            'type' => 'input_number',
        ]);
    }

    /** @see WP_Widget::widget */
    public function widget($args, $instance)
    {
        $post = get_post();
        $depth = array_key_exists('depth', $instance) ? $instance['depth'] : 2;

        $child_of = ($post->ancestors) ? $this->get_shifted_child_page_id($instance, $post) : $post->ID;
        $children = wp_list_pages("title_li=&child_of=$child_of&echo=0&depth=$depth");

        // Set Post Title asheadline
        $headline = get_the_title($child_of);


        if ($children) {
            echo $this->render_view('partials/widget-subnav.html.twig', compact('children', 'headline'));
        }
    }

    /**
     * @param $instance
     * @param $post
     *
     * @return mixed
     */
    protected function get_shifted_child_page_id($instance, $post)
    {
        $shift = array_key_exists('child_of_shift', $instance) ? intval($instance['child_of_shift']) : 0;
        $ancestors = collect(get_post_ancestors($post));

        if ($ancestors->count() == 1) {
            return $ancestors->first();
        }

        return $ancestors->reverse()->splice($shift)->first();
    }
}