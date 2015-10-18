<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentTheme
 */
class ComponentTheme extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( ! $this->filesystem->exists( $this->wp_theme_dir ) && $this->filesystem->exists( $this->install_files_dir . "/theme-default" ) ) {
			$this->filesystem->makeDirectory($this->wp_themes_dir, intval(0776), true);
			$this->filesystem->copyDirectory( "{$this->install_files_dir}/theme-default", $this->wp_theme_dir );
		}
	}
}