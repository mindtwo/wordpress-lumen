<?php

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


function get_sites_config() {
	global $theme_sites_config;

	return $theme_sites_config;
}


function theme_sites() {
	// Set sitenames
	$sites = get_sites_config();

	foreach ( $sites as $key => $site ) {
		$result[ $key ] = array(
			'home' => $site['BASE_URL'],
			'name' => $site['NAME'],
		);
	}

	return $result;
}


function theme_site_id( $callback = true ) {
	global $blog_id;
	if ( $callback ) {
		return $blog_id;
	} else {
		echo $blog_id;
	}
}


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


function get_google_analytics() {
	$config = get_site_config();
	if ( isset( $config['GOOGLE_ANALYTICS'] ) && ! empty( $config['GOOGLE_ANALYTICS'] ) ) {
		return $config['GOOGLE_ANALYTICS'];
	} else {
		return false;
	}
}
