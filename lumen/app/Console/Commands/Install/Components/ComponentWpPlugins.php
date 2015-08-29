<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentWpPlugins
 */
class ComponentWpPlugins extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( isset( $this->config->wordpress_plugins ) ) {
			$plugin_dir = realpath( $this->public_dir . '/wp-content/plugins' );

			foreach ( $this->config->wordpress_plugins as $name => $plugin_data ) {
				if ( ! $this->filesystem->exists( $plugin_dir . "/$name" ) ) {
					if ( $this->filesystem->isWritable( $plugin_dir ) === false ) {
						echo "It does not appear that the current directory ($plugin_dir) is writable.\n";
						echo "Please correct and re-run this script.\n";
						continue;
					}

					echo "Plugin \"$name\" downloading...\n";
					$file = $plugin_dir . '/' . $plugin_data->filename;
					$this->filesystem->put( $file, file_get_contents( $plugin_data->src ) );
					system( "cd $plugin_dir/ && unzip " . $file, $buff );
					$this->filesystem->delete( $file );
					unset( $file );
					unset( $buff );
					echo "Plugin \"$name\" download and installation complete!\n";

				} else {
					echo "Plugin \"$name\" already exists!\n";
				}
			}
		}
	}
}