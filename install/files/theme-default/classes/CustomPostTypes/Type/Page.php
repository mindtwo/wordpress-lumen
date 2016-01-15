<?php

namespace WpTheme\CustomPostTypes\Type;

use WpTheme\CustomPostTypes\CustomPostType;

class Page extends CustomPostType {

	public function __construct() {

		parent::__construct();
		$this->post_type = 'page';

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