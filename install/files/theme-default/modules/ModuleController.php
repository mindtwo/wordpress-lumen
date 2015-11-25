<?php

/**
 * Class ModuleController
 *
 * Basic model operations needed for all models
 */
class ModuleController {

	/**
	 * Data to be saved for this post
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * Meta to be saved for this post, or when loading a existing post, this will be a internal cache of loaded meta values
	 *
	 * @var array
	 */
	protected $meta = array();

	/**
	 * The post ID
	 *
	 * @var int|null
	 */
	protected $ID = null;

	/**
	 * Array of repeatable fields in custom meta boxes
	 *
	 * @var array
	 */
	protected $repeatable_fields = array();

	/**
	 * The post_type, has to be set in child class
	 *
	 * @var string
	 */
	protected static $post_type = '';


	/**
	 * The post_meta prefix used to store meta values, has to be set in child class
	 *
	 * @var string
	 */
	protected static $meta_prefix = 'twint_';

	/**
	 * Initialize
	 *
	 * @param int|null $ID the post_id
	 */
	function __construct( $ID = null ) {

		$this->ID = $ID;

	}

	/**
	 * Set post data
	 *
	 * @param $key
	 * @param $value
	 *
	 * @return $this
	 */
	public function set_data( $key, $value ) {

		$this->data[$key] = $value;

		return $this;

	}

	/**
	 * Set post meta
	 *
	 * @param $key
	 * @param $value
	 *
	 * @return $this
	 */
	public function set_meta( $key, $value ) {

		$this->meta[static::$meta_prefix . $key] = $value;

		return $this;

	}

	/**
	 * Check for existence of meta value
	 *
	 * @param $key
	 *
	 * @return bool
	 */
	public function has_meta( $key ) {

		$meta_value = $this->get_meta( $key );

		if ( empty( $meta_value ) )
			return false;

		return true;
	}

	/**
	 * Load a meta key, save to local storage and return value
	 *
	 * @param $key
	 *
	 * @return mixed
	 */
	public function get_meta( $key ) {
		// add the prefix
		$key = static::$meta_prefix . $key;

		if ( array_key_exists( $key, $this->meta ) ) {
			return $this->meta[$key];
		}

		$flat = true;

		// for some meta values (repeatable fields) we should return arrays
		if ( in_array( $key, $this->repeatable_fields ) )
			$flat = false;

		$this->meta[$key] = get_post_meta( $this->ID, $key, $flat );

		return $this->meta[$key];
	}

	/**
	 * Get the post meta prefix
	 *
	 * @return string
	 */
	public static function get_post_meta_prefix() {

		return static::$meta_prefix;

	}

	/**
	 * Add a new post, set default post data and meta
	 *
	 * @return $this
	 */
	public function create() {

		$this->data = array(
			'post_title' => null,
			'post_status' => 'draft',
			'post_date' => date('Y-m-d H:i:s'),
			'post_type' => static::$post_type,
			'post_content' => null
		);

		return $this;

	}

	/**
	 * Save the current dataset as a new or existing post
	 *
	 * @return int the post ID
	 */
	public function save() {

		if ( isset( $this->ID ) ) {

			$this->data['ID'] = $this->ID;

			// update existing
			wp_update_post( $this->data );
			$post_id = $this->ID;

		} else {

			// add new
			$post_id = wp_insert_post( $this->data );

		}

		foreach ( $this->meta as $k => $v ) {

			update_post_meta( $post_id, $k, $v );

		}

		return $post_id;

	}

}