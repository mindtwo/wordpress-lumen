<?php

namespace WpTheme\Widgets\Widget;

class WidgetCustomSearch extends \WP_Widget {
	function __construct() {
		parent::__construct('WidgetCustomSearch', 'Custom Search Widget ausgeben', array( 'description' => '' ) );
	}

	/** @see WP_Widget::widget */
	function widget( $args, $instance ) {
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
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}

	/** @see WP_Widget::form */
	function form( $instance ) {

	}
}