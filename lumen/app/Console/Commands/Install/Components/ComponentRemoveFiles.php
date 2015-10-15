<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentRemoveFiles
 */
class ComponentRemoveFiles extends ComponentBase implements WpInstallComponentsInterface {

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
		$this->removeWordPressFiles();
		$this->removeOtherInstallFiles();
	}

	/**
	 * Remove WordPress files
	 */
	private function removeWordPressFiles() {
		echo "Remove WordPress selected wordpress files and folders...\n";
		$wordpress_delete_files_and_folders = $this->config->wordpress_delete_files_and_folders;
		foreach ( $wordpress_delete_files_and_folders as $value ) {
			$this->delete_file_or_folder( $this->wp_dir . $value );
		}
	}

	/**
	 * Remove other install files
	 */
	private function removeOtherInstallFiles() {
		echo "Remove selected install files and folders...\n";
		if ( $this->config->remove_install_files_status ) {
			$remove_install_files = $this->config->remove_install_files;
			foreach ( $remove_install_files as $value ) {
				$this->delete_file_or_folder( $this->home_dir . $value );
			}
		}
	}

	/**
	 * Delete a file or a folder
	 *
	 * @param $path
	 *
	 * @return $this|bool
	 */
	private function delete_file_or_folder( $path ) {
		if ( $this->filesystem->isFile( $path ) ) {
			echo "File \"$path\" was removed!\n";
			return $this->filesystem->delete( $path );
		} elseif ( $this->filesystem->isDirectory( $path ) ) {
			echo "Folder \"$path\" was removed!\n";
			return $this->filesystem->deleteDirectory( $path );
		}

		return false;
	}
}

