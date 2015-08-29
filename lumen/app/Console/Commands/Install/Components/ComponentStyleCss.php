<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentStyleCss
 */
class ComponentStyleCss extends ComponentBase implements WpInstallComponentsInterface {

	/**
	 * Create a new command instance.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the component.
	 *
	 * @return mixed
	 */
	public function fire() {
		if ( $this->filesystem->exists( $this->install_templates_dir . '/style.twig.css' ) && ! $this->filesystem->exists( $this->public_dir . "/wp-content/themes/default/style.css" ) ) {

			// Render backup template
			$output = $this->twig->render(
				'style.twig.css',
				array(
					'theme_name'  => ( isset( $this->config->infos->theme_name ) ? $this->config->infos->theme_name : '' ),
					'theme_uri'   => ( isset( $this->config->infos->theme_uri ) ? $this->config->infos->theme_uri : '' ),
					'description' => ( isset( $this->config->infos->description ) ? $this->config->infos->description : '' ),
					'author'      => ( isset( $this->config->infos->author ) ? $this->config->infos->author : '' ),
					'author_mail' => ( isset( $this->config->infos->author_mail ) ? $this->config->infos->author_mail : '' ),
					'author_uri'  => ( isset( $this->config->infos->author_uri ) ? $this->config->infos->author_uri : '' ),
					'version'     => ( isset( $this->config->infos->theme_version ) ? $this->config->infos->theme_version : '999.0' )
				)
			);

			// Write file
			$this->filesystem->put( $this->public_dir . "/wp-content/themes/default/style.css", $output );

			// Unset temp var
			unset( $output );
		}
	}
}