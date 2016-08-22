<?php

namespace WpTheme\PostTypes\Type;

use Illuminate\Support\Facades\Lang;
use WpTheme\PostTypes\CustomPostType;

class Conversion extends CustomPostType {

	public function register() {
		parent::register();
		$this->name = trans('cpt-conversion.labels.name');
		$this->singular_name = 'cpt-conversion.labels.singular-name';

		if( function_exists( 'add_action' ) ) {
			add_action('acf/render_field', [$this, 'action_function_name'], 10, 1);
		}
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

	public function action_function_name($field) {
		if(array_key_exists('key', $field) && $field['key'] == 'field_56d877f078c73') {
			echo '<style type="text/css">#acf-field_56d877f078c73 { display:none; }</style>';
			echo '<iframe style="border:1px solid #DDD; width: 100%; height: 500px;" src="' . $this->get_admin_url() . '?action=conversion_html&conversion_id=562"></iframe>';
		}
	}

	protected function get_admin_url() {
		if(function_exists( 'admin_url' )) {
			return admin_url( 'admin-ajax.php' );
		}

		return '/wp-admin/admin-ajax.php';
	}
}