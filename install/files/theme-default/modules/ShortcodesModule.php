<?php

class ShortcodesModule {

	/**
	 * @var
	 */
	protected $option_fields;

	/**
	 * ShortcodesModule constructor.
	 */
	public function __construct() {

		// Load all option fields at once
		if(function_exists('get_fields')) {
			$this->option_fields = get_fields( 'option' );
		}

		// Register WordPress shortcodes
		$this->register();

	}

	/**
	 * Register WordPress shortcodes
	 */
	public function register() {
		$register_shortcodes = array(

			// Company details
			'get_mobile_phone_number_display' => 'shortcode_get_mobile_phone_number_display',
			'get_mobile_phone_number_href'    => 'shortcode_get_mobile_phone_number_href',
			'get_country'                     => 'shortcode_get_country',
			'get_linkedin'                    => 'shortcode_get_linkedin',
			'get_facebook'                    => 'shortcode_get_facebook',
			'get_xing'                        => 'shortcode_get_xing',
			'get_twitter'                     => 'shortcode_get_twitter',
			'get_google_plus'                 => 'shortcode_get_google_plus',
			'get_pinterest'                   => 'shortcode_get_pinterest',
			'get_instagram'                   => 'shortcode_get_instagram',
			'get_ceo'                         => 'shortcode_get_ceo',
			'get_trade_register'              => 'shortcode_get_trade_register',
			'get_turnover_tax_id'             => 'shortcode_get_turnover_tax_id',
			'get_local_court'                 => 'shortcode_get_local_court',
			'get_company_name'                => 'shortcode_get_company_name',
			'get_street'                      => 'shortcode_get_street',
			'get_zip'                         => 'shortcode_get_zip',
			'get_city'                        => 'shortcode_get_city',
			'get_phone_number_display'        => 'shortcode_get_phone_number_display',
			'get_phone_number_display'        => 'shortcode_get_phone_number_href',
			'get_fax'                         => 'shortcode_get_fax',
			'get_email'                       => 'shortcode_email',

			// Theme
			'responsive_image'            => 'shortcode_responsive_image',
			'hr'                          => 'shortcode_hr',
			'button'                      => 'shortcode_button',
			'box'                         => 'shortcode_box',
			'latest_posts'                => 'shortcode_latest_posts',
			'flexible_contents'           => 'shortcode_flexible_contents',
			'google_analytics_id'         => 'shortcode_google_analytics_id',
			'footer_tracking_codes'       => 'shortcode_footer_tracking_codesText',
			//'contact_form'            => 'shortcode_contact_form',

		);

		// Loop given shortcodes and add them to WordPress
		foreach ( $register_shortcodes as $key => $value ) {
			add_shortcode( $key, array( $this , $value ) );
		}
	}

	/**
	 * Check if ACF options is available as fallback
	 *
	 * @param $pram
	 * @param $value
	 *
	 * @return mixed
	 */
	public function __call( $pram, $value ) {
		if ( isset( $this->option_fields[ str_replace( 'shortcode_get_', '', $pram ) ] ) ) {
			return $this->option_fields[ str_replace( 'shortcode_get_', '', $pram ) ];
		}

		return '';
	}

	/**
	 * Character encode email address
	 *
	 * @return string
	 */
	public function shortcode_email() {
		global $helper;
		return $helper->hash()->encode_all_htmlentities( $this->option_fields['email'] );
	}

	/**
	 * Horizontal line
	 *
	 * @return mixed
	 */
	public function shortcode_hr() {
		return $this->render_view( 'partials/hr.php.twig' );
	}

	/**
	 * Button
	 *
	 * @param $atts
	 *
	 * @return mixed
	 */
	public function button( $atts ) {
		extract( shortcode_atts( array(
			'href'  => '#',
			'label' => false,
			'class' => false,
		), $atts ) );

		return $this->render_view( 'partials/button.php.twig', [ 'href' => $href, 'label' => $label, 'class' => $class ] );
	}

	/**
	 * Contact form
	 *
	 * @param $atts
	 */
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

	/**
	 * Box
	 *
	 * @param      $atts
	 * @param null $content
	 *
	 * @return mixed
	 */
	public function shortcode_box( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'class' => false,
		), $atts ) );

		return $this->render_view( 'partials/box.php.twig', [ 'content' => $content, 'class' => $class ] );
	}

	/**
	 * Latest posts
	 *
	 * @param $atts
	 */
	public function shortcode_latest_posts( $atts ) {
		// TODO: Load and return template
		// return $template;
	}

	/**
	 * Responsive image
	 *
	 * @param $atts
	 */
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

	/**
	 * Register acf flexible contents
	 *
	 * @return mixed|string
	 */
	public function shortcode_flexible_contents() {
		$output = '';

		if ( is_home() ) {
			$post_id = get_field( 'blog_page_id', 'option' );
		} else {
			$post_id = false;
		}

		if ( have_rows( 'flexible-content', $post_id ) ) {
			while ( have_rows( "flexible-content", $post_id ) ) : the_row();
				switch ( get_row_layout() ) {
					case 'col_three_content':
						$output = $this->render_fc_view( 'col_one_content.php.twig' );
						break;
					case 'col_two_content':
						$output = $this->render_fc_view( 'col_three_content.php.twig' );
						break;
					case 'col_one_content':
						$output = $this->render_fc_view( 'col_two_content.php.twig' );
						break;
					case 'shortcode':
						$output = $this->render_fc_view( 'seperator.php.twig' );
						break;
					case 'slider':
						$output = $this->render_fc_view( 'shortcode.php.twig' );
						break;
					case 'intro':
						$output = $this->render_fc_view( 'intro.php.twig' );
						break;
					case 'seperator':
						$output = $this->render_fc_view( 'slider.php.twig' );
						break;
				}
			endwhile;
		}

		return $output;
	}

	/**
	 * Render flexible content view
	 *
	 * @param      $view
	 * @param null $data
	 *
	 * @return mixed
	 */
	private function render_view( $view, $data = null ) {
		return Timber::render( $view, $data, false );
	}

	/**
	 * Render view
	 *
	 * @param      $view
	 * @param null $data
	 *
	 * @return mixed
	 */
	private function render_fc_view( $view, $data = null ) {
		return $this->render_view( 'flexible-contents/' . $view, $data, false );
	}
}

$shortcodes_module = new ShortcodesModule();

// Debug: Show all active shortcodes:
// global $shortcode_tags;
// echo "<pre>"; print_r($shortcode_tags); echo "</pre>";
// die();