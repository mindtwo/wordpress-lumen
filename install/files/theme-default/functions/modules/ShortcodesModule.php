<?php

class ShortcodesModule {

	/**
	 * Shortcodes Module constructor.
	 */
	public function __construct() {

		$register_shortcodes = array(

			// Company details
			'company'          => 'shortcode_company',
			'street'           => 'shortcode_street',
			'zip'              => 'shortcode_zip',
			'city'             => 'shortcode_city',
			'phone'            => 'shortcode_phone',
			'fax'              => 'shortcode_fax',
			'email'            => 'shortcode_email',

			// Theme
			'responsive_image' => 'shortcode_responsive_image',
			'hr'               => 'shortcode_hr',
			'button'           => 'shortcode_button',
			'box'              => 'shortcode_box',
			'latest_posts'     => 'shortcode_latest_posts',
			//'contact_form'   => 'shortcode_contact_form',

		);

		foreach ( $register_shortcodes as $key => $value ) {
			add_shortcode( $key, array( $this, $value ) );
		}

	}

	public function shortcode_hr() {
		return '<div class="hr"><hr></div>';
	}

	public function shortcode_company() {
		return get_field( 'company_name', 'option' );
	}

	public function shortcode_street() {
		return get_field( 'street', 'option' );
	}

	public function shortcode_zip() {
		return get_field( 'zip', 'option' );
	}

	public function shortcode_city() {
		return get_field( 'city', 'option' );
	}

	public function shortcode_phone() {
		return get_field( 'phone_number_display', 'option' );
	}

	public function shortcode_fax() {
		return get_field( 'fax', 'option' );
	}

	public function shortcode_email() {
		global $helper;
		return $helper->hash()->encode_all_htmlentities( get_field( 'email', 'option' ) );
	}

	public function button( $atts ) {
		extract( shortcode_atts( array(
			'href' => '#',
			'text' => ''
		), $atts ) );

		return '<a class="btn-primary" href="' . $href . '">' . $text . '</a>';
	}
	public function contact_form( $atts ) {
		extract( shortcode_atts( array(
			'style'       => 'light',
			'wrap_before' => '<section class="container">',
			'wrap_after'  => '</section>',
			'text'        => ''
		), $atts ) );

		// TODO: Load and return template
		// return $template;
	}

	public function shortcode_box( $atts, $content = null ) {
		return '<div class="box">' . $content . '</div>';
	}

	public function shortcode_latest_posts( $atts ) {
		// TODO: Load and return template
		// return $template;
	}

	public function shortcode_responsive_image( $atts ) {
		extract( shortcode_atts( array(
			'image'            => '#',
			'responsive_image' => '',
			'alt'              => '',
			'image_class'      => '',
		), $atts ) );

		// TODO: Load and return template
		// return $template;
	}
}

$shorcodes_module = new ShortcodesModule();

// Debug: Show all active shortcodes:
// global $shortcode_tags;
// echo "<pre>"; print_r($shortcode_tags); echo "</pre>";