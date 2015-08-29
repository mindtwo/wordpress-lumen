<?php

/**
 * Function to start the session
 *
 * @return boolean return TRUE if a session was successfully started
 */
function myStartSession() {
	$sn = session_name();
	if ( isset( $_COOKIE[ $sn ] ) ) {
		$sessid = $_COOKIE[ $sn ];
	} else if ( isset( $_REQUEST[ $sn ] ) ) {
		$sessid = $_REQUEST[ $sn ];
	} else {
		return session_start();
	}

	if ( ! preg_match( '/^[a-zA-Z0-9,\-]{22,40}$/', $sessid ) ) {
		return false;
	}

	return session_start();
}


/**
 * Function to end the session
 *
 * @return bool
 */
function myEndSession() {
	return session_destroy();
}


/**
 * Start session on load
 */
if ( ! myStartSession() ) {
	session_id( uniqid() );
	session_start();
	session_regenerate_id();
}


/**
 * WordPress session handling
 */
add_action( 'wp_logout', 'myEndSession' );
add_action( 'wp_login', 'myEndSession' );