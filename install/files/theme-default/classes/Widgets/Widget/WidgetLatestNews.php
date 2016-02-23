<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetLatestNews extends WidgetModule {

	/**
	 * Widget constructor.
	 */
	public function __construct($app) {
		// Basics
		$this->widget_name = 'Latest News';
		$this->widget_description = '';

		// Widget Fields
		$this->add_field('headline');
		$this->add_field('subline');

		// Parent Constructor
		parent::__construct($app);
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		$news = do_shortcode('[latest_posts auto_location="true"]');
		echo $this->render_view( 'partials/widget-latest-news.html.twig', compact('news', 'instance'));
	}
}