<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentScreenshot
 */
class ComponentScreenshot extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( isset($this->config->dev_company_slug) && $this->getFile($this->config->dev_company_slug)) {
			$this->filesystem->copy( $this->getFile($this->config->dev_company_slug), $this->public_dir . "/wp-content/themes/default/screenshot.png" );
		}
	}

	/**
	 * Return the project screenshot if it exists
	 *
	 * @param $project_key
	 *
	 * @return bool|string
	 */
	private function getFile($project_key) {
		if($this->filesystem->exists( $this->public_dir . "/wp-content/themes/default/screenshot-{$project_key}.png" )) {
			return $this->public_dir . "/wp-content/themes/default/screenshot-{$project_key}.png";
		}
		return false;
	}
}