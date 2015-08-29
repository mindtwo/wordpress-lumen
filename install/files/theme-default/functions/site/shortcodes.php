<?php

/**
 * HR Shortcode
 */
function addHr() {
	return '<div class="hr"><hr></div>';
}


function shortcode_company() {
	return get_field( 'company_name', 'option' );
}

function shortcode_street() {
	return get_field( 'street', 'option' );
}

function shortcode_zip() {
	return get_field( 'zip', 'option' );
}

function shortcode_city() {
	return get_field( 'city', 'option' );
}

function shortcode_phone() {
	return get_field( 'phone_number_display', 'option' );
}

function shortcode_fax() {
	return get_field( 'fax', 'option' );
}

function shortcode_email() {
	global $helper;

	return $helper->hash()->encode_all_htmlentities( get_field( 'email', 'option' ) );
}


/**
 * Button
 */
function button( $atts ) {
	extract( shortcode_atts( array(
		'href' => '#',
		'text' => ''
	), $atts ) );

	return '<a class="button" href="' . $href . '">' . $text . '</a>';
}


function contact_form( $atts ) {
	extract( shortcode_atts( array(
		'style'       => 'light',
		'wrap_before' => '<section class="container">',
		'wrap_after'  => '</section>',
		'text'        => ''
	), $atts ) );
	ob_start();
	include( THEME_INCLUDES . 'forms/contact_form.php' );
	$content = ob_get_clean();

	if ( $wrap_before || $wrap_after ) {
		return $wrap_before . $content . $wrap_after;
	}

	return $content;
}

/**
 * Box
 */
function box( $atts, $content = null ) {
	return '<div class="box">' . $content . '</div>';
}


function responsiveImage( $atts ) {
	extract( shortcode_atts( array(
		'image'            => '#',
		'responsive_image' => '',
		'alt'              => '',
		'image_class'      => '',
	), $atts ) );

	$template_instance = get_template_instance();
	$template          = $template_instance->render(
		'partials/responsive-image.html.twig',
		array(
			'image'            => $image,
			'image_class'      => $image_class,
			'image_responsive' => $responsive_image,
			'alt'              => $alt,
		)
	);

	return $template;
}

/**
 * ACF Gallery Shortcode
 */
function advanced_gallery( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id' => '1'
	), $atts ) );

	$result = '';
	if ( get_field( 'acf_gallery' ) ) {
		$images = get_field( 'acf_gallery' );
		if ( $images[ $id - 1 ] ):
			$result .= '<ul class="custom_fields_gallery">';
			foreach ( $images[ $id - 1 ]['gallery'] as $image ):
				$result .= '<li>';
				$result .= '<a href="' . $image['sizes']['lightbox'] . '" title="' . $image['caption'] . '" class="lightbox" rel="gallery"><img src="' . $image['sizes']['thumbnail'] . '" alt="' . $image['alt'] . '"></a>';
				$result .= '</li>';
			endforeach;
			$result .= '</ul>';
		endif;
	}

	return $result;
}


/**
 * Load Shortcodes
 */
$available_shortcodes = array(

	// Company details
	'company'          => 'shortcode_company',
	'street'           => 'shortcode_street',
	'zip'              => 'shortcode_zip',
	'city'             => 'shortcode_city',
	'phone'            => 'shortcode_phone',
	'fax'              => 'shortcode_fax',
	'email'            => 'shortcode_email',
	// Theme
	'responsive_image' => 'responsiveImage',
	'contact_form'     => 'contact_form',
	'hr'               => 'addHr',
	'button'           => 'button',
	'box'              => 'box',
	'advanced_gallery' => 'advanced_gallery',
);

foreach ( $available_shortcodes as $key => $value ) {
	add_shortcode( $key, $value );
}


// Debug: Show all active shortcodes:
// global $shortcode_tags;
// echo "<pre>"; print_r($shortcode_tags); echo "</pre>";