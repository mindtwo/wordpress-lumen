<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetCustomSearch extends WidgetModule {

	/**
	 * Widget constructor.
	 */
	public function __construct($app) {
		// Basics
		$this->widget_name = 'Custom Search Widget ausgeben';
		$this->widget_description = '';

		// Widget Fields
		$this->add_field('headline');
		$this->add_field('subline');

		// Parent Constructor
		parent::__construct($app);
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		extract( $args );
		echo $this->render_view( 'partials/widget-searchbox.html.twig', ['home_url' => home_url('/')]);
	}
}