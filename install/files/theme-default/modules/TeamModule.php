<?php

class TeamModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'team',
			array(
				'labels' => array(
					'name' => trans('module-team.labels.name'),
					'singular_name' => trans('module-team.labels.singular-name'),
					'all_items' => trans('module-team.labels.all-items'),
					'add_new' => trans('module-team.labels.add-new'),
					'add_new_item' => trans('module-team.labels.add-new-item'),
					'edit' => trans('module-team.labels.edit'),
					'edit_item' => trans('module-team.labels.edit-item'),
					'new_item' => trans('module-team.labels.new-item'),
					'view_item' => trans('module-team.labels.view-item'),
					'search_items' => trans('module-team.labels.search-items'),
					'not_found' => trans('module-team.labels.not-found'),
					'not_found_in_trash' => trans('module-team.labels.not-found-in-trash'),
					'parent_item_colon' => trans('module-team.labels.parent-item-colon')
				),
				'description' => trans('module-team.description'),
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 25,
				'menu_icon' =>'dashicons-groups', // Select an icon: https://developer.wordpress.org/resource/dashicons/
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
			'team-category',
			'team',
			array(
				'label' => trans('module-team.team-category.label'),
				'public' => true,
				'rewrite' => array( 'slug' => 'team-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$team_module = new TeamModule();

