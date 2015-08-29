<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentBackupSettings
 */
class ComponentBackupSettings extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( $this->filesystem->exists( $this->install_templates_dir . '/backup-bash-script.twig.sh' ) ) {
			// Render backup template
			$output = $this->twig->render(
				'backup-bash-script.twig.sh',
				array(
					'NAME'       => $this->config->project_slug,
					'DB_USER'    => $this->config->database->user,
					'DB_PASS'    => $this->config->database->pass,
					'DB_NAME'    => $this->config->database->name,
					'DB_HOST'    => $this->config->database->host,
					'SCRIPTPATH' => $this->backup_dir,
				)
			);

			$this->addFolders();

			// Write backup bash script
			$this->filesystem->put( $this->backup_dir . '/start.sh', $output );
			unset( $output );
		}
	}

	/**
	 * Add backup folders
	 */
	private function addFolders() {
		if(!$this->filesystem->exists( $this->backup_dir )) {
			$this->filesystem->makeDirectory($this->backup_dir, 0755, true);
		}

		if(!$this->filesystem->exists( $this->backup_dir . '/backups' )) {
			$this->filesystem->makeDirectory($this->backup_dir . '/backups', 0755, true);
		}
	}
}