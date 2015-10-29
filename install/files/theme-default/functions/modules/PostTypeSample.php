<?php

class PostTypeSample {

	public function __construct() {

		// add_action( 'init', array( $this, 'register_post_types' ));
		// add_action( 'init', array( $this, 'register_custom_tags' ));
		// add_action( 'init', array( $this, 'register_custom_taxonomies' ));

	}

	/**
	 * Custom Post Type
	 */
	public function register_post_types() {
		register_post_type( 'team', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
			// let's now add all the options for this post type
			array(
				'labels' => array(
					'name' => 'Team', /* This is the Title of the Group */
					'singular_name' => 'Team', /* This is the individual type */
					'all_items' => 'All team members', /* the all items menu item */
					'add_new' => 'Add New', /* The add new menu item */
					'add_new_item' => 'Add New team member', /* Add New Display Title */
					'edit' => 'Edit', /* Edit Dialog */
					'edit_item' => 'Edit team member', /* Edit Display Title */
					'new_item' => 'New team member', /* New Display Title */
					'view_item' => 'View team member', /* View Display Title */
					'search_items' => 'Search team member', /* Search Custom Type Title */
					'not_found' =>  'Nothing found in the Database.', /* This displays if there are no entries yet */
					'not_found_in_trash' => 'Nothing found in Trash', /* This displays if there is nothing in the trash */
					'parent_item_colon' => ''
				),
				/* end of arrays */
				'description' => 'This is the team member', /* Custom Type Description */
				'public' => true,
				'publicly_queryable' => true,
				'exclude_from_search' => false,
				'show_ui' => true,
				'query_var' => true,
				'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
				'menu_icon' =>'dashicons-businessman', /* the icon for the custom post type menu */
				'rewrite' => array(
					'slug' => 'team', /* you can specify its url slug */
					'with_front' => false,
				),
				'has_archive' => 'custom_type', /* you can rename the slug here */
				'capability_type' => 'page',
				'hierarchical' => false,

				/* the next one is important, it tells what's enabled in the post editor */
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'sticky',
				)
			)
		);
	}

	/**
	 * for more information on taxonomies, go here:
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	public function register_custom_taxonomies() {
		// now let's add custom categories (these act like categories)
		register_taxonomy( 'custom_cat',
			array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
			array(
				'hierarchical' => true, /* if this is true, it acts like categories */
				'labels' => array(
					'name' => '', /* name of the custom taxonomy */
					'singular_name' => '', /* single taxonomy name */
					'search_items' =>  ' durchsuchen', /* search title for taxomony */
					'all_items' => 'Alle ', /* all title for taxonomies */
					'parent_item' => '', /* parent title for taxonomy */
					'parent_item_colon' => '', /* parent taxonomy title */
					'edit_item' => '', /* edit custom taxonomy title */
					'update_item' => ' aktualisieren', /* update title for taxonomy */
					'add_new_item' => '', /* add new title for taxonomy */
					'new_item_name' => '' /* name title for taxonomy */
				),
				'show_admin_column' => true,
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => array(
					'slug' => '',
				),
			)
		);
	}

	/**
	 * for more information on taxonomies, go here:
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	public function register_custom_tags() {
		// now let's add custom tags (these act like categories)
		register_taxonomy( 'custom_tag',
			array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
			array(
				'hierarchical' => false,    /* if this is false, it acts like tags */
				'labels' => array (
					'name' => '', /* name of the custom taxonomy */
					'singular_name' => '', /* single taxonomy name */
					'search_items' =>  ' durchsuchen', /* search title for taxomony */
					'all_items' => 'Alle ', /* all title for taxonomies */
					'parent_item' => '', /* parent title for taxonomy */
					'parent_item_colon' => '', /* parent taxonomy title */
					'edit_item' => '', /* edit custom taxonomy title */
					'update_item' => ' aktualisieren', /* update title for taxonomy */
					'add_new_item' => '', /* add new title for taxonomy */
					'new_item_name' => '' /* name title for taxonomy */
				),
				'show_admin_column' => true,
				'show_ui' => true,
				'query_var' => true,
			)
		);
	}
}