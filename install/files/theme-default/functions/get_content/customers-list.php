<?php

/**
 * Returns Custom Post Type Customers
 *
 * @param int $limit
 *
 * @return string
 */
function get_customers_list( $limit = 50 ) {
	// The Query
	$the_query = new WP_Query( array( 'post_type' => 'customers', 'posts_per_page' => $limit ) );

	// The Loop
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$thumbnail_image = get_thumbnail_image();

			$list[] = array(
				'thumbnail'   => $thumbnail_image,
				'id'          => get_the_ID(),
				'title'       => get_the_title(),
				'description' => get_field( 'description', get_the_ID() ),
				'permalink'   => get_permalink( get_the_ID() ),
			);
		}
	}

	// Restore original post data
	wp_reset_postdata();

	//return template
	$template_instance = get_template_instance();

	return $template_instance->render(
		'partials/customers-list.html.twig',
		array(
			'id'   => get_the_ID(),
			'list' => $list,
		)
	);
}