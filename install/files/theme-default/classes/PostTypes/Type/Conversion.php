<?php

namespace WpTheme\PostTypes\Type;

use Illuminate\Support\Facades\Lang;
use WpTheme\PostTypes\CustomPostType;

class Conversion extends CustomPostType {

	public function __construct() {

		parent::__construct();
		$this->post_type = 'conversion';
		$this->name = 'Conversions';
		$this->singular_name = 'Conversion';

	}

	/**
	 * Custom Post Type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	public function register_post_type() {
		$custom_params = [
			'public' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'menu_icon' =>'dashicons-chart-area', // Select an icon: https://developer.wordpress.org/resource/dashicons/
			'rewrite' => array( 'slug' => 'conversion', 'with_front' => false ),
			'supports' => array( 'title'),
		];

		register_post_type( $this->post_type, array_merge($this->post_type_params, $custom_params) );
	}

	/**
	 * Register Custom Post Type Taxonomies
	 */
	public function register_taxonomy() {
		$taxonomy_name = $this->post_type . '-source';
		$taxonomy_slug = $this->post_type . '-source';

		register_taxonomy(
			$taxonomy_name,
			$this->post_type,
			array(
				'label' => trans('cpt-conversion.conversion-source.label'),
				'public' => true,
				'rewrite' => array( 'slug' => $taxonomy_slug, 'with_front' => false ),
				'hierarchical' => false,
			)
		);
	}
}