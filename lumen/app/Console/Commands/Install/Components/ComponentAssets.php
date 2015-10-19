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

		// Check if assets dir exists
		if ( $this->filesystem->exists( $this->wp_assets_dir ) ) { echo "Dir {$this->wp_assets_dir} already exists.\n"; return false; }

		// Move folders
		if ( $this->isGulpSelected() ) {
			$this->moveSelectedAssetsDir("{$this->install_files_dir}/assets-with-gulp");
			$this->createGulpSymlinks();
		} elseif ( $this->isGulpNotSelected() ) {
			$this->removeWithoutGulpFiles();
			$this->moveSelectedAssetsDir("{$this->install_files_dir}/assets-without-gulp");
		}
	}


	/**
	 * Is gulp selected
	 *
	 * @return mixed
	 */
	protected function isGulpSelected() {
		return ($this->config->gulp == true && $this->filesystem->exists( $this->install_files_dir . '/assets-with-gulp' ));
	}


	/**
	 * Is gulp not selected
	 *
	 * @return mixed
	 */
	protected function isGulpNotSelected() {
		return ($this->config->gulp != true && $this->filesystem->exists( $this->install_files_dir . '/assets-without-gulp' ));
	}


	/**
	 * Move selected assets dir to the right spot
	 *
	 * @return mixed
	 */
	protected function moveSelectedAssetsDir($dir) {
		echo "Dir \"$dir\" moved to: \"{$this->wp_assets_dir}\"!\n";
		$this->filesystem->copyDirectory($dir , $this->wp_assets_dir );
	}


	/**
	 * Create gulp symlinks
	 *
	 * @return mixed
	 */
	protected function createGulpSymlinks() {
		$this->createFontsDirsForSymlinks();

		foreach($this->gulp_symlinks as $symlink) {
			echo "Symlink \"$symlink\" was created!\n";
			system( "cd {$this->wp_fonts_dir} && ln -s $symlink", $buff );
		}
	}


	/**
	 * Make fonts dirs for symlinks
	 *
	 * @return mixed
	 */
	protected function createFontsDirsForSymlinks() {
		if(!$this->filesystem->exists( $this->wp_fonts_dir )) {
			echo "Make fonts dirs for symlinks.\n";
			$this->filesystem->makeDirectory($this->wp_fonts_dir, 0755, true);
		}
	}


	/**
	 * Remove without gulp files
	 *
	 * @return mixed
	 */
	protected function removeWithoutGulpFiles() {
		// Remove gulp dependencies
		foreach($this->gulp_delete_files as $file) {
			if ( $this->filesystem->exists( $file ) ) {
				echo "File \"$file\" removed!\n";
				$this->filesystem->delete( $file );
			}
		}
	}
}