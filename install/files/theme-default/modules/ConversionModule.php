<?php

use Illuminate\Support\Facades\Lang;

class ConversionModule extends ModuleController {
	protected $translator;

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));
		$this->translator = new Lang;

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'conversion',
			array(
				'labels' => array(
					'name' => trans('module-conversion.labels.name'),
					'singular_name' => trans('module-conversion.labels.singular-name'),
					'all_items' => trans('module-conversion.labels.all-items'),
					'add_new' => trans('module-conversion.labels.add-new'),
					'add_new_item' => trans('module-conversion.labels.add-new-item'),
					'edit' => trans('module-conversion.labels.edit'),
					'edit_item' => trans('module-conversion.labels.edit-item'),
					'new_item' => trans('module-conversion.labels.new-item'),
					'view_item' => trans('module-conversion.labels.view-item'),
					'search_items' => trans('module-conversion.labels.search-items'),
					'not_found' => trans('module-conversion.labels.not-found'),
					'not_found_in_trash' => trans('module-conversion.labels.not-found-in-trash'),
					'parent_item_colon' => trans('module-conversion.labels.parent-item-colon')
				),
				'description' => trans('module-conversion.description'),
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
			'conversion-source',
			'conversion',
			array(
				'label' => trans('module-conversion.conversion-source.label'),
				'public' => true,
				'rewrite' => array( 'slug' => 'conversion-source', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$conversion_module = new ConversionModule();