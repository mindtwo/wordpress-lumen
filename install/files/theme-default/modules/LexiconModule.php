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
					'name' => 'Lexicon',
					'singular_name' => 'Lexicon',
					'all_items' => 'All Lexicon entries',
					'add_new' => 'Add Lexicon entry',
					'add_new_item' => 'Add New Lexicon entry',
					'edit' => 'Edit',
					'edit_item' => 'Edit Lexicon entry',
					'new_item' => 'New Lexicon entry',
					'view_item' => 'View Lexicon entry',
					'search_items' => 'Search Lexicon entry',
					'not_found' =>  'Nothing found in the Database.',
					'not_found_in_trash' => 'Nothing found in Trash',
					'parent_item_colon' => ''
				),
				'description' => 'Website Lexicon',
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
				'label' => 'Category',
				'public' => true,
				'rewrite' => array( 'slug' => 'lexicon-category', 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}

$lexicon_module = new LexiconModule();