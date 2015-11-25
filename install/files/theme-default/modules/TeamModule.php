<?php

class TeamModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'team',
			array(
				'labels' => array(
					'name' => 'Team',
					'singular_name' => 'Team',
					'all_items' => 'All team members',
					'add_new' => 'Add New',
					'add_new_item' => 'Add New team member',
					'edit' => 'Edit',
					'edit_item' => 'Edit team member',
					'new_item' => 'New team member',
					'view_item' => 'View team member',
					'search_items' => 'Search team member',
					'not_found' =>  'Nothing found in the Database.',
					'not_found_in_trash' => 'Nothing found in Trash',
					'parent_item_colon' => ''
				),
				'description' => 'This is the team member',
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 8,
				'menu_icon' =>'dashicons-businessman', // Select an icon: https://developer.wordpress.org/resource/dashicons/
				'rewrite' => array( 'slug' => 'team', 'with_front' => false ),
				'has_archive' => 'custom_type',
				'capability_type' => 'page',
				'hierarchical' => false,
				'supports' => array( 'title', 'editor', 'thumbnail', 'sticky')
			)
		);
	}
}

$team_module = new TeamModule();

