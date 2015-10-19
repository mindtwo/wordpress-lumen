<?php

namespace App\Console\Commands\Install\Components;

use Hampel\Json\Json;
use Hampel\Json\JsonException;
use Illuminate\Console\Command;

abstract class ComponentBase extends Command {

	protected $filesystem;
	protected $twig;
	protected $config;
	protected $home_dir;
	protected $lumen_dir;
	protected $assets_dir;
	protected $public_dir;
	protected $backup_dir;
	protected $install_config_dir;
	protected $install_templates_dir;
	protected $install_files_dir;
	protected $wp_dir;
	protected $wp_upload_dir;
	protected $wp_plugin_dir;
	protected $wp_theme_dir;
	protected $wp_languages_dir;
	protected $wp_themes_dir;
	protected $wp_assets_dir;
	protected $wp_fonts_dir;
	protected $bower_folder;
	protected $gulp_delete_files;
	protected $gulp_symlinks;

	/**
	 * ComponentBase constructor.
	 */
	public function __construct() {
		// Define app pathes
		$this->home_dir              = realpath( base_path() . '/../' );
		$this->lumen_dir             = $this->home_dir . '/lumen';
		$this->assets_dir            = $this->home_dir . '/resources/assets';
		$this->public_dir            = $this->home_dir . '/public';
		$this->backup_dir            = $this->home_dir . '/backup';
		$this->install_config_dir    = $this->home_dir . '/install/config';
		$this->install_templates_dir = $this->home_dir . '/install/views';
		$this->install_files_dir     = $this->home_dir . '/install/files';
		$this->wp_themes_dir         = $this->public_dir . '/content/themes';
		$this->wp_theme_dir          = $this->public_dir . '/content/themes/default';
		$this->wp_dir                = $this->public_dir . '/wordpress';
		$this->wp_upload_dir         = $this->public_dir . '/content/uploads';
		$this->wp_plugin_dir         = $this->public_dir . '/content/plugins';
		$this->wp_languages_dir      = $this->public_dir . '/content/languages';
		$this->wp_assets_dir         = $this->wp_theme_dir . '/assets';
		$this->wp_fonts_dir          = $this->wp_assets_dir . '/fonts';
		$this->bower_folder          = $this->assets_dir . 'bower_components';

		// Delete files if gulp is not selected
		$this->delete_files = [
			$this->home_dir . '/resources/assets',
			$this->home_dir . 'package.json',
			$this->home_dir . '.bowerrc',
			$this->home_dir . 'bower.json',
			$this->home_dir . 'gulpfile.js',
		];

		// Symlinks if gulp is selected
		$this->symlinks = [
			$this->bower_folder . "/bootstrap-sass/assets/fonts/bootstrap bootstrap",
			$this->bower_folder . "/fontawesome/fonts fontawesome"
		];


		// Load required components
		$this->filesystem = app( "files" );
		$this->twig       = app( "TwigInstaller" );

		// Load config file
		try {
			$this->config = Json::decode( $this->filesystem->get( $this->install_config_dir . "/install-config.json" ) );
		} catch ( JsonException $e ) {
			echo $e->getMessage();
		}
	}
}