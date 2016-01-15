<?php

namespace WpTheme\CustomPostTypes\Type;

use WpTheme\CustomPostTypes\CustomPostType;

class _Sample extends CustomPostType {

	public function __construct() {

		parent::__construct();
		$this->post_type = '_sample';
		$this->name = '_Samples';
		$this->singular_name = '_Sample';

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		$custom_params = [
			'menu_icon' =>'dashicons-groups', // Select an icon: https://developer.wordpress.org/resource/dashicons/
			'rewrite' => array( 'slug' => '_sample', 'with_front' => false ),
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
				'label' => trans('cpt-default.taxonomy.label'),
				'public' => true,
				'rewrite' => array( 'slug' => $taxonomy_slug, 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}