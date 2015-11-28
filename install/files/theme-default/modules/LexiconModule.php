<?php

class LexiconModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'lexicon',
			array(
				'labels' => array(
					'name' => trans('module-lexicon.labels.name'),
					'singular_name' => trans('module-lexicon.labels.singular-name'),
					'all_items' => trans('module-lexicon.labels.all-items'),
					'add_new' => trans('module-lexicon.labels.add-new'),
					'add_new_item' => trans('module-lexicon.labels.add-new-item'),
					'edit' => trans('module-lexicon.labels.edit'),
					'edit_item' => trans('module-lexicon.labels.edit-item'),
					'new_item' => trans('module-lexicon.labels.new-item'),
					'view_item' => trans('module-lexicon.labels.view-item'),
					'search_items' => trans('module-lexicon.labels.search-items'),
					'not_found' => trans('module-lexicon.labels.not-found'),
					'not_found_in_trash' => trans('module-lexicon.labels.not-found-in-trash'),
					'parent_item_colon' => trans('module-lexicon.labels.parent-item-colon')
				),
				'description' => trans('module-lexicon.description'),
				'public' => false,
				'publicly_queryable' => false,
				'exclude_from_search' => true,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 25,
				'menu_icon' =>'dashicons-book-alt', // Select an icon: https://developer.wordpress.org/resource/dashicons/
				'rewrite' => array( 'slug' => 'lexicon', 'with_front' => false ),
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
			'lexicon-category',
			'lexicon',
			array(
				'label' => trans('module-lexicon.lexicon-category.label'),
				'public' => true,
				'rewrite' => array( 'slug' => 'lexicon-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$lexicon_module = new LexiconModule();