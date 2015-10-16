<?php

function get_theme_assets_path() {
	return THEME_ASSETS_LIVE;
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
	return theme_config_file('comment')['default'];
}

function primary_menu($name='main-menu') {
	ob_start();
	wp_nav_menu( array(
		'theme_location' => $name,
		'container' => 'nav',
		'depth' => 2,
		'container_id' => 'bs-example-navbar-collapse-1',
		'container_class' => 'collapse navbar-collapse',
		'menu_class' => 'nav navbar-nav',
		'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
		'walker'=> new wp_bootstrap_navwalker()
	));
	$content = ob_get_contents(); ob_end_clean();
	return $content;
}

function footer_menu($name='main-footer') {
	ob_start();
	if(has_nav_menu($name)) {
		wp_nav_menu( array(
			'theme_location' => $name,
			'container'      => false,
			'depth'          => 1,
			'link_before'    => '<span class="fa fa-chevron-right"></span>',
			'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
			'walker'         => new wp_bootstrap_navwalker()
		) );
	}
	$content = ob_get_contents(); ob_end_clean();
	return $content;
}


// Load is_home() Blog Frontpage postdata
function get_home_pagedata() {
	// Get "Blog Page ID"
	$page_id = get_option('page_on_front');

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