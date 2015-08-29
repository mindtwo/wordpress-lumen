<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentAssets
 */
class ComponentAssets extends ComponentBase implements WpInstallComponentsInterface {

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
		$assets_folder = "{$this->wp_theme_dir}/assets";
		$fonts_folder = "{$assets_folder}/fonts";
		$bower_folder = "./../../../../../../resources/assets/bower_components/";


		if ( $this->filesystem->exists( $this->public_dir . '/wp-content/themes/default/assets' ) ) { return false; }

		if ( $this->config->gulp == true && $this->filesystem->exists( $this->install_files_dir . '/assets-with-gulp' ) ) {
			$this->filesystem->copyDirectory( "{$this->install_files_dir}/assets-with-gulp", $assets_folder );

			// Make font dirs for symlincs
			if(!$this->filesystem->exists( $fonts_folder )) {
				$this->filesystem->makeDirectory($fonts_folder, 0755, true);
			}

			// Create symlinks
			system( "cd {$fonts_folder} && ln -s {$bower_folder}bootstrap-sass/assets/fonts/bootstrap bootstrap", $buff );
			system( "cd {$fonts_folder} && ln -s {$bower_folder}fontawesome/fonts fontawesome", $buff );

		} elseif ( $this->config->gulp != true && $this->filesystem->exists( $this->install_files_dir . '/assets-without-gulp' ) ) {
			$this->filesystem->delete( $this->home_dir . '/resources/assets' );
			$this->filesystem->copyDirectory( "{$this->install_files_dir}/assets-without-gulp", $assets_folder );
		}
	}
}