<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentBackup
 */
class ComponentBackup extends ComponentBase implements WpInstallComponentsInterface {

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
		system( "cd {$this->backup_dir} && bash start.sh", $buff );
		unset( $buff );
	}
}