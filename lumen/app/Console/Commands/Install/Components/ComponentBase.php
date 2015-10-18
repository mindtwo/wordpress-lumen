<?php

namespace App\Console\Commands\Install\Components;

use Hampel\Json\Json;
use Hampel\Json\JsonException;
use Illuminate\Console\Command;

abstract class ComponentBase extends Command {

	public $filesystem;
	public $twig;
	public $config;
	public $home_dir;
	public $lumen_dir;
	public $assets_dir;
	public $public_dir;
	public $backup_dir;
	public $install_config_dir;
	public $install_templates_dir;
	public $install_files_dir;
	public $wp_dir;
	public $wp_upload_dir;
	public $wp_plugin_dir;
	public $wp_theme_dir;
	public $wp_themes_dir;


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
		$this->wp_plugin_dir        = $this->public_dir . '/content/plugins';


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