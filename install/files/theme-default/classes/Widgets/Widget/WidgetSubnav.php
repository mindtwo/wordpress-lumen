<?php

namespace WpTheme\Widgets\Widget;

use WpTheme\Widgets\WidgetModule;

class WidgetSubnav extends WidgetModule {

	/**
	 * Widget constructor.
	 */
	public function __construct($app) {
		// Basics
		$this->widget_name = 'Subnavigation Widget';
		$this->widget_description = '';

		// Widget Fields
		$this->add_field('headline');
		$this->add_field('subline');
		$this->add_field('child_of_shift', [
			'title' => 'Shift Menu Start',
			'type' => 'input_number',
		]);
		$this->add_field('depth', [
			'type' => 'input_number',
		]);


		// Parent Constructor
		parent::__construct($app);
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		$post = get_post();
		$depth = array_key_exists('depth', $instance) ? $instance['depth'] : 2;

		$child_of = ( $post->ancestors ) ? $this->get_shifted_child_page_id( $instance, $post ) : $post->ID ;
		$children = wp_list_pages("title_li=&child_of=$child_of&echo=0&depth=$depth");

		// Replace markers from backend fields
		$selected_location = $this->app->make('ACF')->get_selected_location();
		$location = (is_array($selected_location) && array_key_exists('name', $selected_location)) ? $selected_location['name'] : false;
		(array_key_exists('headline',$instance)) ? $instance['headline'] = $this->compile_string($instance['headline'], ['location' => $location]) : false;
		(array_key_exists('subline',$instance)) ? $instance['subline'] = $this->compile_string($instance['subline'], ['location' => $location]) : false;

		if( $children ){
			echo $this->render_view( 'partials/widget-subnav.html.twig', compact('children', 'instance') );
		}
	}

	/**
	 * @param $instance
	 * @param $post
	 *
	 * @return mixed
	 */
	protected function get_shifted_child_page_id( $instance, $post ) {
		$child_of_shift = array_key_exists('child_of_shift', $instance) ? intval($instance['child_of_shift']) : 0;
		$ancestors = get_post_ancestors( $post );

		if ( $child_of_shift != 0 && count( $post->ancestors ) > $child_of_shift ) {
			for ( $i = 1; $i <= $child_of_shift; $i ++ ) {
				array_pop( $ancestors );
			}

			return end( $ancestors );
		}

		return $post->ID;
	}
}