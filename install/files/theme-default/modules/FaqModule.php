<?php

class FaqModule extends ModuleController {

	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ));

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		register_post_type( 'faq',
			array(
				'labels' => array(
					'name' => 'FAQ',
					'singular_name' => 'FAQ',
					'all_items' => 'All FAQs',
					'add_new' => 'Add FAQ',
					'add_new_item' => 'Add New FAQ',
					'edit' => 'Edit',
					'edit_item' => 'Edit FAQ',
					'new_item' => 'New FAQ',
					'view_item' => 'View FAQ',
					'search_items' => 'Search FAQ',
					'not_found' =>  'Nothing found in the Database.',
					'not_found_in_trash' => 'Nothing found in Trash',
					'parent_item_colon' => ''
				),
		      'description' => 'This is the FAQ',
		      'public' => true,
		      'publicly_queryable' => true,
		      'exclude_from_search' => false,
		      'show_ui' => true,
		      'query_var' => true,
		      'menu_position' => 8,
		      'menu_icon' =>'dashicons-editor-help', // Select an icon: https://developer.wordpress.org/resource/dashicons/
		      'rewrite' => array( 'slug' => 'faq', 'with_front' => false ),
		      'has_archive' => 'custom_type',
		      'capability_type' => 'page',
		      'hierarchical' => true,
			  'supports' => array( 'title', 'editor')
			)
		);
	}
}

$faq_module = new FaqModule();