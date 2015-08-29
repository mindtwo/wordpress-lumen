<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentDotenvFile
 */
class ComponentDotenvFile extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( $this->filesystem->exists( $this->lumen_dir . '/.env' ) ) {

			// Init
			$output = $this->filesystem->get( $this->lumen_dir . '/.env' );

			// Add database data
			echo "Lumen dotenv configuration\n";
			$output = preg_replace( '/(DB_USERNAME\=)(.+)/', '${1}' . $this->config->database->user, $output );
			$output = preg_replace( '/(DB_PASSWORD\=)(.+)/', '${1}' . $this->config->database->pass, $output );
			$output = preg_replace( '/(DB_DATABASE\=)(.+)/', '${1}' . $this->config->database->name, $output );
			$output = preg_replace( '/(DB_CHARSET\=)(.+)/', '${1}' . $this->config->database->charset, $output );
			$output = preg_replace( '/(DB_HOST\=)(.+)/', '${1}' . $this->config->database->host, $output );

			// Set secret salts in config.php (https://api.wordpress.org/secret-key/1.1/salt/)
			$salt   = str_replace( '$', '', password_hash( time() . uniqid(), PASSWORD_BCRYPT ) . password_hash( uniqid() . time(), PASSWORD_BCRYPT ) );
			$output = preg_replace( '/(APP_KEY\=)(SomeRandomKey.+)/', '${1}' . $salt, $output );

			// Write dotenv config file
			echo "Write \"{$this->lumen_dir}/.env\" file.\n";
			$this->filesystem->put( "{$this->lumen_dir}/.env", $output );
			unset( $output );
		}
	}
}