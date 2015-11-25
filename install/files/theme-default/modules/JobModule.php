<?php

class JobModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'job',
			array(
				'labels' => array(
					'name' => 'Jobs',
					'singular_name' => 'Job',
					'all_items' => 'All Job',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New Job',
					'edit' => 'Edit',
					'edit_item' => 'Edit Job',
					'new_item' => 'New Job',
					'view_item' => 'View Job',
					'search_items' => 'Search Job',
					'not_found' =>  'Nothing found in the Database.',
					'not_found_in_trash' => 'Nothing found in Trash',
					'parent_item_colon' => ''
				),
				'description' => 'This is the Job',
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 25,
				'menu_icon' =>'dashicons-businessman', // Select an icon: https://developer.wordpress.org/resource/dashicons/
				'rewrite' => array( 'slug' => 'team', 'with_front' => false ),
				'has_archive' => false,
				'capability_type' => 'page',
				'hierarchical' => false,
				'supports' => array( 'title', 'editor', 'thumbnail', 'sticky')
			)
		);
	}


	/**
	 * Register Custom Post Type Taxonomies
	 */
	public function register_taxonomy() {
		register_taxonomy(
			'job-category',
			'job',
			array(
				'label' => 'Category',
				'public' => true,
				'rewrite' => array( 'slug' => 'job-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$job_module = new JobModule();

