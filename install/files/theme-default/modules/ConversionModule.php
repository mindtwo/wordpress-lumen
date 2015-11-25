<?php

class ConversionModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'conversion',
			array(
				'labels' => array(
					'name' => 'Conversions',
					'singular_name' => 'Conversion',
					'all_items' => 'All Conversions',
					'add_new' => 'Add Conversion',
					'add_new_item' => 'Add New Conversion',
					'edit' => 'Edit',
					'edit_item' => 'Edit Conversion',
					'new_item' => 'New Conversion',
					'view_item' => 'View Conversion',
					'search_items' => 'Search Conversion',
					'not_found' =>  'Nothing found in the Database.',
					'not_found_in_trash' => 'Nothing found in Trash',
					'parent_item_colon' => ''
				),
				'description' => 'Website Conversions',
				'public' => false,
				'publicly_queryable' => false,
				'exclude_from_search' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 25,
				'menu_icon' =>'dashicons-chart-area', // Select an icon: https://developer.wordpress.org/resource/dashicons/
				'rewrite' => array( 'slug' => 'conversion', 'with_front' => false ),
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
			'conversion-category',
			'conversion',
			array(
				'label' => 'Category',
				'public' => true,
				'rewrite' => array( 'slug' => 'conversion-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$conversion_module = new ConversionModule();