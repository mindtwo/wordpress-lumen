<?php

function footerNav( $nav_name ) {
	wp_nav_menu( array(
		'theme_location' => $nav_name,
		'container'      => false,
		'depth'          => 1,
		'link_before'    => '<span class="fa fa-chevron-right"></span>',
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'fallback_cb'    => 'wp_bootstrap_navwalker::fallback',
		'walker'         => new wp_bootstrap_navwalker()
	) );
}