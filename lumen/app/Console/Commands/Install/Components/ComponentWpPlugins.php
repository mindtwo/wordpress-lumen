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

			// Create directory
			if(! $this->filesystem->exists( $this->wp_plugin_dir )) {
				$this->filesystem->makeDirectory($this->wp_plugin_dir, intval(0776), true);
			}

			foreach ( $this->config->wordpress_plugins as $name => $plugin_data ) {
				if ( ! $this->filesystem->exists( $this->wp_plugin_dir . "/$name" ) && $name != 'wp_cli') {


					// Check permissions
					if ( $this->filesystem->isWritable( $this->wp_plugin_dir ) === false ) {
						echo "It does not appear that the current directory ($this->wp_plugin_dir) is writable.\n";
						echo "Please correct and re-run this script.\n";
						continue;
					}

					// Get plugins
					echo "Plugin \"$name\" downloading...\n";
					$file = $this->wp_plugin_dir . '/' . $plugin_data->filename;
					$this->filesystem->put( $file, file_get_contents( $plugin_data->src ) );
					system( "cd $this->wp_plugin_dir/ && unzip " . $file, $buff );
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