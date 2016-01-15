<?php

namespace WpTheme\PostTypes\Type;

use WpTheme\PostTypes\CustomPostType;

class Lexicon extends CustomPostType {

	public function __construct() {

		parent::__construct();
		$this->post_type = 'lexicon';

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		$custom_params = [
			'menu_icon' =>'dashicons-book-alt', // Select an icon: https://developer.wordpress.org/resource/dashicons/
			'exclude_from_search' => true,
			'rewrite' => array( 'slug' => 'lexicon', 'with_front' => false ),
			'supports' => array( 'title', 'editor'),
		];

		register_post_type( $this->post_type, array_merge($this->post_type_params, $custom_params) );
	}

	/**
	 * Register Custom Post Type Taxonomies
	 */
	public function register_taxonomy() {
		$taxonomy_name = $this->post_type . '-category';
		$taxonomy_slug = $this->post_type . '-category';

		register_taxonomy(
			$taxonomy_name,
			$this->post_type,
			array(
				'label' => trans('cpt-lexicon.lexicon-category.label'),
				'public' => true,
				'rewrite' => array( 'slug' => $taxonomy_slug, 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}