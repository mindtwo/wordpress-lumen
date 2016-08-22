<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetCustomSearch extends WidgetModule {

	public function register() {
		// Basics
		$this->widget_name        = 'Custom Search Widget ausgeben';
		$this->widget_description = '';

		// Widget Fields
		$this->add_field( 'headline' );
		$this->add_field( 'subline' );
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		extract( $args );
		echo $this->render_view( 'partials/widget-searchbox.html.twig', ['home_url' => home_url('/')]);
	}
}