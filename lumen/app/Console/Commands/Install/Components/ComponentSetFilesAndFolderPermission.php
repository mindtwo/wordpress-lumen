<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentSetFilesAndFolderPermission
 */
class ComponentSetFilesAndFolderPermission extends ComponentBase implements WpInstallComponentsInterface {

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

		$permissions = [
			'find "'.$this->home_dir.'/public/" -type d -exec chmod 776 {} \;',
			'find "'.$this->home_dir.'/public/content/uploads" -type d -exec chmod 776 {} \;',
			'find "'.$this->home_dir.'/public/content/plugins" -type d -exec chmod 776 {} \;',
			'find "'.$this->home_dir.'/public/content/languages" -type d -exec chmod 776 {} \;',
			'find "'.$this->home_dir.'/public/" -type f -exec chmod 644 {} \;',
			'chmod 660 "'.$this->home_dir.'/public/wp-config.php"',
			'chmod 660 "'.$this->home_dir.'/public/wordpress/wp-config.php"',
		];

		foreach($permissions as $permission) {
			system( $permission, $buff );
			echo "\"$permission\" was executed!\n";
		}
	}
}