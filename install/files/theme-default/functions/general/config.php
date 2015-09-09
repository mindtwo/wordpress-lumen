<?php

function theme_config_file($filename) {
	// Load file
	$config = include(THEME_CONFIG . $filename . '.php');

	// Check for multisite support
	if(defined('MULTISITE') && MULTISITE && array_key_exists(get_current_blog_id(), $config)) {

		// Check if there are global settings
		if(array_key_exists(0,$config) && array_key_exists(get_current_blog_id(),$config)) {

			// Merge with current blog id configuration
			return array_merge($config[0], $config[get_current_blog_id()]);

		} else {

			// Returns current blog id configuration data
			return $config[get_current_blog_id()];

		}

	} else {
		// Check if there are global settings
		if(array_key_exists(0,$config) && array_key_exists(1,$config)) {

			// Merge with default blog id configuration
			return array_merge($config[0], $config[1]);

		} else {

			// Return config file directly
			return $config[0];

		}
	}
}
