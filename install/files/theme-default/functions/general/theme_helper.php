<?php

function get_theme_assets_path() {
	if ( THEME_ENV == 'live' && defined( 'THEME_ASSETS_LIVE' ) ) {
		return THEME_ASSETS_LIVE;
	}

	return THEME_ASSETS_DEV;
}

function theme_css_path() {
	echo get_theme_assets_path() . 'css/';
}

function theme_js_path() {
	echo get_theme_assets_path() . 'js/';
}

function theme_images_path( $callback = false ) {
	if ( $callback ) {
		return get_theme_assets_path() . 'images/';;
	}
	echo get_theme_assets_path() . 'images/';
}

function svg_ready() {
	global $detect;

	if ( $detect->browser() == 'IE' && $detect->version( $detect->browser() ) < 9 ) {
		return false;
	} else {
		return true;
	}
}

function svg_ready_prefix( $default = '.jpg' ) {
	if ( svg_ready() ) {
		echo '.svg';
	} else {
		echo $default;
	}
}

function is_mobile() {
	global $detect;
	if ( $detect->isMobile() ) {
		return true;
	}

	return false;
}

function is_tablet() {
	global $detect;
	if ( $detect->isTablet() ) {
		return true;
	}

	return false;
}

function mobile_image_prefix() {
	if ( is_mobile() ) {
		return '-mobile';
	} else {
		return '';
	}
}

function theme_comment() {
	return theme_config_file('comment')['mindtwo'];
}


// Load is_home() Blog Frontpage postdata
function get_is_home_pagedata() {
	if ( function_exists( 'get_field' ) ) {
		// Get "Blog Page ID" from ACF Option Fields
		$page_id = get_field( 'blog_page_id', 'option' );

		// Get Post
		$page = get_post( $page_id );

		// Return Resultset
		return array(
			'this'    => $page,
			'id'      => $page_id,
			'title'   => $page->post_title,
			'content' => apply_filters( 'the_content', $page->post_content ),
		);
	}

	return false;
}

// Twig Template Engine for WordPress
function get_template_instance() {
	$theme_template_path = rtrim( TEMPLATE_DIR, '/' ) . '/';
	$theme_storage_path  = rtrim( THEME_STORAGE, '/' ) . '/';
	Twig_Autoloader::register();
	$loader = new Twig_Loader_Filesystem( $theme_template_path );

	// return new Twig_Environment($loader,array('cache' => $theme_storage_path.'twig/compilation_cache'));
	return new Twig_Environment( $loader, array( 'cache' => false ) );
}


function col_two_container_layout_option_classes() {
	if ( strpos( get_sub_field( 'col_two_container_layout_option' ), '70-30' ) !== false ) {
		return array( array( 'col-md-8' ), array( 'col-md-4' ) );
	} elseif ( strpos( get_sub_field( 'col_two_container_layout_option' ), '30-70' ) !== false ) {
		return array( array( 'col-md-4' ), array( 'col-md-8' ) );
	} else {
		return array( array( 'col-md-6' ), array( 'col-md-6' ) );
	}
}

