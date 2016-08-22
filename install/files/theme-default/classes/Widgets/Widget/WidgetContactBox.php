<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetContactBox extends WidgetModule {

	/**
	 * @return mixed
	 */
	public function register() {
		// Basics
		$this->widget_name = 'Contact Box';
		$this->widget_description = '';

		// Widget Fields
		$this->add_field('headline');
		$this->add_field('subline');
		$this->add_field('button_shortcode');
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		$selected_location = $this->app->make('AddonACF')->get_selected_location();
		$button = do_shortcode($instance['button_shortcode']);
		echo $this->render_view( 'partials/widget-contactbox.html.twig', compact('selected_location', 'instance', 'button'));
	}
}