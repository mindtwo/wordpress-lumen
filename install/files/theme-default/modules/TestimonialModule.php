<?php

class TestimonialModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'testimonial',
			array(
				'labels' => array(
					'name' => trans('module-testimonial.labels.name'),
					'singular_name' => trans('module-testimonial.labels.singular-name'),
					'all_items' => trans('module-testimonial.labels.all-items'),
					'add_new' => trans('module-testimonial.labels.add-new'),
					'add_new_item' => trans('module-testimonial.labels.add-new-item'),
					'edit' => trans('module-testimonial.labels.edit'),
					'edit_item' => trans('module-testimonial.labels.edit-item'),
					'new_item' => trans('module-testimonial.labels.new-item'),
					'view_item' => trans('module-testimonial.labels.view-item'),
					'search_items' => trans('module-testimonial.labels.search-items'),
					'not_found' => trans('module-testimonial.labels.not-found'),
					'not_found_in_trash' => trans('module-testimonial.labels.not-found-in-trash'),
					'parent_item_colon' => trans('module-testimonial.labels.parent-item-colon')
				),
				'description' => trans('module-testimonial.description'),
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 25,
				'menu_icon' =>'dashicons-format-quote', // Select an icon: https://developer.wordpress.org/resource/dashicons/
				'rewrite' => array( 'slug' => 'testimonial', 'with_front' => false ),
				'has_archive' => false,
				'capability_type' => 'page',
				'hierarchical' => true,
				'supports' => array( 'title', 'editor')
			)
		);
	}

	/**
	 * Register Custom Post Type Taxonomies
	 */
	public function register_taxonomy() {
		register_taxonomy(
			'testimonial-type',
			'testimonial',
			array(
				'label' => trans('module-testimonial.testimonial-type.label'),
				'public' => true,
				'rewrite' => array( 'slug' => 'testimonial-type', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$testimonial_module = new TestimonialModule();