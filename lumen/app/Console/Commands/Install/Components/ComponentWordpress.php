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

		if ( $this->filesystem->exists( $this->public_dir . '/wp-config-sample.php' ) || $this->filesystem->exists( $this->public_dir . '/wp-config.php' ) ) {
			echo "It appears that Wordpress has already been already uploaded and/or installed.\n";
			echo "This utility is designed for clean installs only.\n";
		} else {
			if ( $this->filesystem->isWritable( $this->public_dir ) === false ) {
				echo "It does not appear that the current directory is writable.\n";
				echo "Please correct and re-run this script.\n";
			}

			$url                = $this->config->wordpress_version->install;
			$wordpress_tar_file = $this->public_dir . "/" . basename( $url );
			if ( $this->filesystem->exists( $wordpress_tar_file ) ) {
				echo "Old WordPress file exists and was deleted!\n";
				$this->filesystem->delete( $wordpress_tar_file );
			}
			echo "WordPress downloading...\n";
			$this->filesystem->put( $wordpress_tar_file, file_get_contents( $url ) );
			echo "WordPress complete!\n";

			echo "Extract WordPress...\n";
			system( "cd {$this->public_dir} && tar -zxvf " . $wordpress_tar_file . " --strip-components 1", $buff );

			// Remove package
			echo "Remove WordPress archive!\n";
			$this->filesystem->delete( $wordpress_tar_file );

			// Unset temp vars
			unset( $url );
			unset( $wordpress_tar_file );
			unset( $buff );
		}
	}
}