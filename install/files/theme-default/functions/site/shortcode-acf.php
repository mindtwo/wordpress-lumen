<?php

/**
 * ACF Image/Text Box Shortcode
 */
function acf_shortcode_image_text_button( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'name' => false
	), $atts );

	// Set shortcode key
	$key = $atts['name'];

	// Load fields
	$content = acf_shortcode_load_option_subfield( $key, array(
		'headline',
		'content',
		'image',
		'button',
		'button_text'
	) );

	// Image
	if ( isset( $content['image'] ) ) {
		$img = '
            <div class="image">
                <img src="' . $content['image']['sizes']['thumbnail'] . '" alt="' . $content['image']['alt'] . '" />
            </div>
        ';
	} else {
		$img = '';
	}


	// Button
	if ( isset( $content['button'] ) && isset( $content['button_text'] ) ) {
		$button = '
            <p class="buttonWrapper">
                <a href="' . $content['button'] . '" class="button">' . $content['button_text'] . '</a>
            </p>
        ';
	} else {
		$button = '';
	}

	// Set output
	$output = '';
	$output .= '<div class="shortcodeBox acf_shortcode_' . $key . ' equalHeight">';
	$output .= '<h4>' . $content['headline'] . '</h4>';
	$output .= $img;
	$output .= '<div class="content">' . $content['content'] . '</div>';
	$output .= '</div>';
	$output .= $button;

	// Return output
	return $output;
}


/**
 * ACF Latest News Shortcode
 */
function acf_shortcode_box_latest_news( $atts, $content = null ) {
	// Set shortcode key
	$key = 'latest_news';

	// Load fields
	$content = acf_shortcode_load_option_subfield( $key, array( 'button', 'button_text' ) );

	// Button
	if ( isset( $content['button'] ) && isset( $content['button_text'] ) ) {
		$button = '
            <p class="buttonWrapper">
                <a href="' . $content['button'] . '" class="button">' . $content['button_text'] . '</a>
            </p>
        ';
	} else {
		$button = '';
	}

	// Set output depending on post content
	$output = '';
	$output .= '<div class="shortcodeBox acf_shortcode_' . $key . ' equalHeight">';

	// query last post and including in output
	query_posts( array( 'orderby' => 'date', 'order' => 'DESC', 'showposts' => 1 ) );
	if ( have_posts() ):
		while ( have_posts() ) : the_post();
			$output .= '<h4>' . get_the_title() . '</h4>';

			// show thumbnail or video if exist
			if ( has_post_thumbnail() ):
				global $post_id;
				$output .= '
                    <p class="postImage"><a href="' . get_permalink() . '" title="' . get_the_title() . '">' .
				           get_the_post_thumbnail( $post_id, 'medium' )
				           . '</a></p>
                ';
			endif;

			$output .= get_the_excerpt();
			$output .= '
                <p class="buttonWrapper">
                    <a class="moreLink" href="' . get_permalink() . '" title="' . get_the_title() . '"><span class="fa fa-long-arrow-right"></span>Zum Beitrag</a>
                </p>
            ';
		endwhile;
	else:
		$output .= '<h4>Keine Aktuellen Meldungen gefunden.</h4>';
	endif;

	wp_reset_query();

	$output .= '</div>';
	$output .= $button;

	// Return output
	return $output;
}