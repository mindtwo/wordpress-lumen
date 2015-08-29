<?php

/**
 * Simple next prev pager
 *
 * @param bool $next
 * @param bool $prev
 *
 * @return string
 *
 */
function pager_simple_next_prev( $next = false, $prev = false ) {

	if ( get_next_post_link( '%link', 'Next' ) ) {
		$next_tmp = get_next_post_link( '%link', 'Neuere' );

		preg_match( '/(?:<a\s)(?:href=")(https?:\/\/[^"]*)(?:.[^>]+>)(.[^<]*)(?:<\/a>)/', $next_tmp, $src );
		$next = array(
			'link' => ( ! empty( $src[1] ) ) ? $src[1] : false,
			'text' => ( $next != false ) ? $next : $src[2],
		);
	} else {
		$next = false;
	}

	if ( get_previous_post_link( '%link', 'Previous' ) ) {
		$prev_tmp = get_previous_post_link( '%link', 'Ältere' );
		preg_match( '/(?:<a\s)(?:href=")(https?:\/\/[^"]*)(?:.[^>]+>)(.[^<]*)(?:<\/a>)/', $prev_tmp, $src );
		$prev = array(
			'link' => ( ! empty( $src[1] ) ) ? $src[1] : false,
			'text' => ( $prev != false ) ? $prev : $src[2],
		);
	} else {
		$prev = false;
	}


	$template_instance = get_template_instance();

	return $template_instance->render(
		'partials/pager_simple_next_prev.html.twig',
		array(
			'next' => $next,
			'prev' => $prev,
		)
	);
}
