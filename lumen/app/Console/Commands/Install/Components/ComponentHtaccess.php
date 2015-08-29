<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentHtaccess
 */
class ComponentHtaccess extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( $this->filesystem->exists( $this->install_templates_dir . '/htaccess.twig.conf' ) && ! $this->filesystem->exists( $this->public_dir . "/.htaccess" ) ) {
			// Render backup template
			$output = $this->twig->render(
				'htaccess.twig.conf',
				array(
					'auth'      => $this->config->basicauth->status,
					'auth_file' => $this->home_dir . '/.htpasswd',
				)
			);

			// Write file
			$this->filesystem->put( $this->public_dir . "/.htaccess", $output );

			// Unset temp var
			unset( $output );
		}
	}
}

