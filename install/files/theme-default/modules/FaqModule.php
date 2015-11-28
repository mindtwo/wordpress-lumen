<?php

class FaqModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'faq',
			array(
				'labels' => array(
					'name' => trans('module-faq.labels.name'),
					'singular_name' => trans('module-faq.labels.singular-name'),
					'all_items' => trans('module-faq.labels.all-items'),
					'add_new' => trans('module-faq.labels.add-new'),
					'add_new_item' => trans('module-faq.labels.add-new-item'),
					'edit' => trans('module-faq.labels.edit'),
					'edit_item' => trans('module-faq.labels.edit-item'),
					'new_item' => trans('module-faq.labels.new-item'),
					'view_item' => trans('module-faq.labels.view-item'),
					'search_items' => trans('module-faq.labels.search-items'),
					'not_found' => trans('module-faq.labels.not-found'),
					'not_found_in_trash' => trans('module-faq.labels.not-found-in-trash'),
					'parent_item_colon' => trans('module-faq.labels.parent-item-colon')
				),
				'description' => trans('module-faq.description'),
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 25,
				'menu_icon' =>'dashicons-editor-help', // Select an icon: https://developer.wordpress.org/resource/dashicons/
				'rewrite' => array( 'slug' => 'faq', 'with_front' => false ),
				'has_archive' => 'custom_type',
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
			'faq-category',
			'faq',
			array(
				'label' => trans('module-faq.faq-category.label'),
				'public' => true,
				'rewrite' => array( 'slug' => 'faq-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$faq_module = new FaqModule();