<?php

namespace WpTheme\PostTypes;

use ReflectionClass;

/**
 * Class CustomPostType
 *
 * Basic model operations needed for all custom post types
 */
abstract class CustomPostType extends PostType {

	/**
	 * @var string
     */
	protected $name = '';

	/**
	 * @var string
     */
	protected $singular_name = '';

	/**
	 * @var array
     */
	protected $post_type_params = [];

	/**
	 * Initialize
	 */
	function __construct() {

		// Get classname as default post type name
		$reflect = new ReflectionClass($this);
		$class_name = str_replace(['Shortcode',], '', $reflect->getShortName());
		$this->post_type = $this->camel_case_to_undercore_case($class_name);
		$this->name = ucwords($this->post_type);
		$this->singular_name = ucwords($this->post_type);
		$this->set_default_post_type_params();
	}

	/**
	 * Register action
	 */
	public function register() {
		add_action( 'init', array( $this, 'register_post_type' ));
		add_action( 'init', array( $this, 'register_taxonomy' ));
	}

	/**
	 * @return mixed
     */
	abstract public function register_post_type();

	/**
	 * @return mixed
     */
	abstract public function register_taxonomy();

	/**
	 * @return array
     */
	protected function get_labels() {
		// Set defaults
		$labels = [
			'name' => trans('cpt-default.labels.name', ['name' => $this->name]),
			'singular_name' => trans('cpt-default.labels.singular-name', ['name' => $this->singular_name]),
			'menu_name' => $this->name,
			'name_admin_bar' => $this->singular_name,
			'all_items' => trans('cpt-default.labels.all-items', ['name' => $this->name]),
			'add_new' => trans('cpt-default.labels.add-new'),
			'add_new_item' => trans('cpt-default.labels.add-new-item', ['name' => $this->singular_name]),
			'edit' => trans('cpt-default.labels.edit'),
			'edit_item' => trans('cpt-default.labels.edit-item', ['name' => $this->singular_name]),
			'new_item' => trans('cpt-default.labels.new-item', ['name' => $this->singular_name]),
			'view_item' => trans('cpt-default.labels.view-item', ['name' => $this->singular_name]),
			'search_items' => trans('cpt-default.labels.search-items', ['name' => $this->name]),
			'not_found' => trans('cpt-default.labels.not-found'),
			'not_found_in_trash' => trans('cpt-default.labels.not-found-in-trash'),
			'parent_item_colon' => trans('cpt-default.labels.parent-item-colon', ['name' => $this->singular_name])
		];

		// Autotranslate from translation files
		foreach($labels as $key => $label){
			$name = str_replace('_', '-', $key);
			if(hasTrans("cpt-{$this->post_type}.labels.$name")) {
				$labels[$key] = trans("cpt-{$this->post_type}.labels.$name");
			}
		}

		return $labels;
	}

	/**
	 * Set default cpt params
     */
	protected function set_default_post_type_params() {
		$this->post_type_params = [
			'labels' => $this->get_labels(),
			'description' => trans('cpt-default.description', ['name' => $this->name]),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 25,
			'has_archive' => false,
			'capability_type' => 'page',
			'hierarchical' => false,
			'supports' => array( 'title', 'editor', 'thumbnail')
		];
	}

	/**
	 * Converts a camel case string to a lowercase underscore string
	 *
	 * @param $input
	 *
	 * @return string
	 */
	protected function camel_case_to_undercore_case($input) {
		preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
		$ret = $matches[0];
		foreach ($ret as &$match) {
			$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
		}
		return implode('_', $ret);
	}
}