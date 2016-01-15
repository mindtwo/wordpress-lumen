<?php

/**
 * Register sidebar widgets
 */
if ( function_exists( 'register_sidebar' ) ) {
	$sidebars = array( 'Default', 'Contact', 'Job Single', 'Job Overview', 'Team Single', 'Blog Single' );
	foreach ( $sidebars as $name ) {

		$name_id = strtolower( str_replace( ' ', '_', $name ) );
		register_sidebar( array(
			'name'          => $name,
			'id'            => 'custom-sidebar-' . $name_id,
			'before_widget' => '<section  id="%1$s" class="box widget %2$s"><div class="content">',
			'after_widget'  => '</div></section>',
			'description'   => 'Eingefügte Widgets werden rechts in der Sidebar eingeblendet',
			'before_title'  => '<strong class="widget-title">',
			'after_title'   => '</strong>',
		) );
	}
}