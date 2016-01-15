<?php

namespace WpTheme\CustomPostTypes\Type;

use WpTheme\CustomPostTypes\CustomPostType;

class Post extends CustomPostType {

	public function __construct() {

		parent::__construct();
		$this->post_type = 'post';

	}

	/**
	 * @return mixed
	 */
	public function register_post_type() {}

	/**
	 * @return mixed
	 */
	public function register_taxonomy() {}

}