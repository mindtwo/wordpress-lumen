<?php

class FaqModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));

	}

	/**
	 * Custom Post Type
	 */
	public function register_post_type() {
		register_post_type( 'faq', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
			// let's now add all the options for this post type
			array('labels' => array(
				'name' => 'FAQ', /* This is the Title of the Group */
				'singular_name' => 'FAQ', /* This is the individual type */
				'all_items' => 'All FAQs', /* the all items menu item */
				'add_new' => 'Add FAQ', /* The add new menu item */
				'add_new_item' => 'Add New FAQ', /* Add New Display Title */
				'edit' => 'Edit', /* Edit Dialog */
				'edit_item' => 'Edit FAQ', /* Edit Display Title */
				'new_item' => 'New FAQ', /* New Display Title */
				'view_item' => 'View FAQ', /* View Display Title */
				'search_items' => 'Search FAQ', /* Search Custom Type Title */
				'not_found' =>  'Nothing found in the Database.', /* This displays if there are no entries yet */
				'not_found_in_trash' => 'Nothing found in Trash', /* This displays if there is nothing in the trash */
				'parent_item_colon' => ''
			), /* end of arrays */
			      'description' => 'This is the FAQ', /* Custom Type Description */
			      'public' => true,
			      'publicly_queryable' => true,
			      'exclude_from_search' => false,
			      'show_ui' => true,
			      'query_var' => true,
			      'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			      'menu_icon' =>'dashicons-pressthis', /* the icon for the custom post type menu: https://developer.wordpress.org/resource/dashicons/ */
			      'rewrite' => array( 'slug' => 'faq', 'with_front' => false ), /* you can specify its url slug */
			      'has_archive' => 'custom_type', /* you can rename the slug here */
			      'capability_type' => 'page',
			      'hierarchical' => true,
				/* the next one is important, it tells what's enabled in the post editor */
				  'supports' => array( 'title', 'editor')
			) /* end of options */
		); /* end of register post type */
	}
}

$faq_module = new FaqModule();