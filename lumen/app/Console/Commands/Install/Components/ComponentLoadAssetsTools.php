<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentLoadAssetsTools
 */
class ComponentLoadAssetsTools extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( !$this->isGulpSelected() ) { return true; }

		$tools = [
			'npm install',
			'bower install -y',
			'gulp',
		];

		foreach($tools as $tool) {
			echo "Tool bash script \"$tool\" was executed!\n";
			system( "cd {$this->home_dir} && $tool", $buff );
		}
	}
}