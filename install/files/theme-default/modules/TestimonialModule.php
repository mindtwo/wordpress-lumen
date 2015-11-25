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
					'name' => 'Testimonials',
					'singular_name' => 'Testimonial',
					'all_items' => 'All Testimonials',
					'add_new' => 'Add Testimonial',
					'add_new_item' => 'Add New Testimonial',
					'edit' => 'Edit',
					'edit_item' => 'Edit Testimonial',
					'new_item' => 'New Testimonial',
					'view_item' => 'View Testimonial',
					'search_items' => 'Search Testimonial',
					'not_found' =>  'Nothing found in the Database.',
					'not_found_in_trash' => 'Nothing found in Trash',
					'parent_item_colon' => ''
				),
				'description' => 'Customers and Partners Testimonial',
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
			'testimonial-category',
			'testimonial',
			array(
				'label' => 'Category',
				'public' => true,
				'rewrite' => array( 'slug' => 'testimonial-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$testimonial_module = new TestimonialModule();