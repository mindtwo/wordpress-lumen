<?php

namespace WpTheme\Modules\Ajax;

class AjaxRegister {

	/**
	 * @var array
	 */
	public $types = [
		\WpTheme\Modules\Ajax\Requests\BlogPosts::class,
	];

	/**
	 * Register modules
	 */
	public function __construct() {
		foreach($this->types as $type) {
			new $type;
		}
	}

}