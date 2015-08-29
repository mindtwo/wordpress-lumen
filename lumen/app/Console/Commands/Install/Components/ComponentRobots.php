<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentRobots
 */
class ComponentRobots extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( $this->filesystem->exists( $this->install_templates_dir . '/robots.twig.txt' ) && ! $this->filesystem->exists( $this->install_templates_dir . "/robots.txt" ) ) {
			// Render backup template
			$output = $this->twig->render(
				'robots.twig.txt'
			);

			// Write file
			$this->filesystem->put( $this->public_dir . "/robots.txt", $output );
			unset( $output );
		}
	}
}