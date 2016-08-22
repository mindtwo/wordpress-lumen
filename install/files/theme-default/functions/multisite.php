<?php

/**
 * Load configuration file of all sites
 * @return mixed List of all sites
 */
function get_sites_config() {
	$config = app('config');
	return $config->get('sites');
}


/**
 * Set site specific configuration file
 * @param null $id
 *
 * @return bool Site specific configuration
 */
function get_site_config( $id = null ) {
	global $blog_id;
	$theme_sites_config = get_sites_config();

	if ( ! is_null( $id ) ) {
		return $theme_sites_config;
	} elseif ( isset( $theme_sites_config[ $blog_id ] ) ) {
		return $theme_sites_config[ $blog_id ];
	}

	return false;
}


/**
 * Loop all theme sites
 *
 * @return mixed List of all sites but only home and name field
 */
function theme_sites() {
	// Set sitenames
	$sites = get_sites_config();

	return $sites;
}



/**
 * @param bool|true $callback
 *
 * @return mixed
 */
function theme_site_id( $callback = true ) {
	global $blog_id;
	if ( $callback ) {
		return $blog_id;
	} else {
		echo $blog_id;
	}
}


/**
 * Get theme name
 *
 * @param bool|false $callback
 *
 * @return string
 */
function theme_site_name( $callback = false ) {
	// Load current multisite blog id
	global $blog_id;

	$sites = theme_sites();

	// Set result
	if ( isset( $sites[ $blog_id ] ) ) {
		$result = $sites[ $blog_id ]['name'];
	} else {
		$result = 'undefined';
	}

	// Return
	if ( $callback ) {
		return $result;
	} else {
		echo $result;
	}
}