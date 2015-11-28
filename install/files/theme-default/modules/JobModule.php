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
					'name' => trans('module-job.labels.name'),
					'singular_name' => trans('module-job.labels.singular-name'),
					'all_items' => trans('module-job.labels.all-items'),
					'add_new' => trans('module-job.labels.add-new'),
					'add_new_item' => trans('module-job.labels.add-new-item'),
					'edit' => trans('module-job.labels.edit'),
					'edit_item' => trans('module-job.labels.edit-item'),
					'new_item' => trans('module-job.labels.new-item'),
					'view_item' => trans('module-job.labels.view-item'),
					'search_items' => trans('module-job.labels.search-items'),
					'not_found' => trans('module-job.labels.not-found'),
					'not_found_in_trash' => trans('module-job.labels.not-found-in-trash'),
					'parent_item_colon' => trans('module-job.labels.parent-item-colon')
				),
				'description' => trans('module-job.description'),
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 25,
				'menu_icon' =>'dashicons-id', // Select an icon: https://developer.wordpress.org/resource/dashicons/
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
				'label' => trans('module-job.job-category.label'),
				'public' => true,
				'rewrite' => array( 'slug' => 'job-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$job_module = new JobModule();

