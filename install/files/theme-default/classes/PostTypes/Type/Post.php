<?php

namespace WpTheme\PostTypes\Type;

use WpTheme\PostTypes\PostType;

class Post extends PostType {

	public function __construct() {

		parent::__construct();
		$this->post_type = 'post';

	}

}