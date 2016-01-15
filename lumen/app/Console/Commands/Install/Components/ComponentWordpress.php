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

		if ( $this->filesystem->exists( $this->wp_dir . '/wp-config-sample.php' ) || $this->filesystem->exists( $this->public_dir . '/wp-config.php' ) ) {
			echo "It appears that Wordpress has already been already uploaded and/or installed.\n";
			echo "This utility is designed for clean installs only.\n";
		} else {

			// Check if directory is writable
			if ( $this->filesystem->isWritable( $this->public_dir ) === false ) {
				echo "It does not appear that the current directory is writable.\n";
				echo "Please correct and re-run this script.\n";
			}

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

			unset( $buff );
		}
	}
}