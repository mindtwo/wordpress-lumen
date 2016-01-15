<?php

namespace WpTheme\Widgets\Widget;

use WP_Widget;

class WidgetCustomSearch extends WP_Widget {

	/**
	 * WidgetCustomSearch constructor.
	 * TODO: Add translations
     */
	public function __construct() {
		parent::__construct('WidgetCustomSearch', 'Custom Search Widget ausgeben', array( 'description' => '' ) );
	}

	/** @see WP_Widget::widget */
	public function widget( $args, $instance ) {
		extract( $args );
        $template_instance = get_template_instance();
    	$template    = $template_instance->render(
    		'partials/widget-searchbox.html.twig',
    		array(
    			'home_url' => home_url('/')
    		)
    	);

		echo $before_widget . $template . $after_widget;
	}

	/** @see WP_Widget::update */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}

	/** @see WP_Widget::form */
	public function form( $instance ) {

	}

}