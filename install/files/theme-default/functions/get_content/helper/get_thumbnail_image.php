<?php

/**
 * @param string $imagesize
 * @param null   $id
 *
 * @return array
 */
function get_thumbnail_image( $imagesize = 'square', $id = null ) {
	if ( is_null( $id ) ) {
		$id = get_the_ID();
	}

	$post_thumbnail_id   = get_post_thumbnail_id( $id );
	$post_thumbnail_meta = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );

	$image            = wp_get_attachment_image_src( $post_thumbnail_id, "$imagesize-square" )[0];
	$image_large      = wp_get_attachment_image_src( $post_thumbnail_id, "fancybox" )[0];
	$image_responsive = wp_get_attachment_image_src( $post_thumbnail_id, "$imagesize-mobile" )[0];

	return array(
		'alt'              => $post_thumbnail_meta,
		'image'            => $image,
		'image_large'      => $image_large,
		'image_responsive' => $image_responsive,
	);
}