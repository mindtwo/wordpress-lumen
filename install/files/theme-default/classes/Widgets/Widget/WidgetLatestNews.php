<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetLatestNews extends WidgetModule {

	/**
	 * @return mixed
	 */
	public function register() {
		// Basics
		$this->widget_name = 'Latest News';
		$this->widget_description = '';

		// Widget Fields
		$this->add_field('headline');
		$this->add_field('count');
		$this->add_field('subline');
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		$count = array_key_exists('count',$instance) && is_numeric($instance['count']) ? $instance['count'] : 1 ;
		$news = do_shortcode('[latest_posts count="'.$count.'"]');

		// Replace markers from backend fields
		(array_key_exists('headline',$instance)) ? $instance['headline'] = $this->compile_string($instance['headline']) : false;
		(array_key_exists('subline',$instance)) ? $instance['subline'] = $this->compile_string($instance['subline']) : false;

		echo $this->render_view( 'partials/widget-latest-news.html.twig', compact('news', 'instance'));
	}
}