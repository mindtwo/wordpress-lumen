<?php

if(has_post_thumbnail()) {
	if(is_singular( array('team') ) ) {
		$fancy_box = true;
	} else {
		$fancy_box = false;
	}

	if(!is_single() && !is_singular() ) {
		$permalink = get_permalink();
	} else {
		$permalink = false;
	}

	$post_thumbnail_id   = get_post_thumbnail_id( get_the_ID() );
	$post_thumbnail_url  = wp_get_attachment_url( $post_thumbnail_id );
	$post_thumbnail_meta = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );

	$image            = wp_get_attachment_image_src( $post_thumbnail_id, 'square' )[0];
	$image_large      = wp_get_attachment_image_src( $post_thumbnail_id, 'fancybox' )[0];
	$image_responsive = wp_get_attachment_image_src( $post_thumbnail_id, 'square-mobile' )[0];
	$template_instance = get_template_instance();
	$template    = $template_instance->render(
		'partials/blog-list-thumbnail.html.twig',
		array(
			'image'            => $image,
			'image_large'      => $image_large,
			'image_responsive' => ( $image_responsive ) ? $image_responsive : $image,
			'alt'              => $post_thumbnail_meta,
			'permalink'        => $permalink,
			'fancybox'         => $fancy_box,
		)
	);
	echo $template;
}