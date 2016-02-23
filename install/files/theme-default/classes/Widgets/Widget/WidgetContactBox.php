<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetContactBox extends WidgetModule {

	/**
	 * Widget constructor.
	 */
	public function __construct($app) {
		// Basics
		$this->widget_name = 'Contact Box';
		$this->widget_description = '';

		// Widget Fields
		$this->add_field('headline');
		$this->add_field('subline');
		$this->add_field('button_shortcode');

		// Parent Constructor
		parent::__construct($app);
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		$button = do_shortcode($instance['button_shortcode']);
		echo $this->render_view( 'partials/widget-contactbox.html.twig', compact('instance', 'button'));
	}
}