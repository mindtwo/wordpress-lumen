<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentWordpress
 */
class ComponentWordpress extends ComponentBase implements WpInstallComponentsInterface {

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
			// Create WordPress directory
			if ( ! $this->filesystem->exists( $this->wp_dir ) ) {
				echo "Create directory: '" . $this->wp_dir . "'...\n";
				$this->filesystem->makeDirectory( $this->wp_dir, intval( 0776 ), true );
			}

			// Create WordPress uploads directory
			if ( ! $this->filesystem->exists( $this->wp_upload_dir ) ) {
				echo "Create directory: '" . $this->wp_upload_dir . "'...\n";
				$this->filesystem->makeDirectory($this->wp_upload_dir, intval(0776), true);
			}

			// Create WordPress languages directory
			if ( ! $this->filesystem->exists( $this->wp_languages_dir ) ) {
				echo "Create directory: '" . $this->wp_languages_dir . "'...\n";
				$this->filesystem->makeDirectory($this->wp_languages_dir, intval(0776), true);
			}
		}
	}
}