<?php

namespace App\Console\Commands\Install\Components;

use Illuminate\Support\Str;

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
			$output = preg_replace( '/(APP_LOCALE\=)(.+)/', '${1}' . $this->config->language, $output );
			$output = preg_replace( '/(APP_FALLBACK_LOCALE\=)(.+)/', '${1}' . $this->config->language_fallback, $output );

			$output = preg_replace( '/(DB_USERNAME\=)(.+)/', '${1}' . $this->config->database->user, $output );
			$output = preg_replace( '/(DB_PASSWORD\=)(.+)/', '${1}' . $this->config->database->pass, $output );
			$output = preg_replace( '/(DB_DATABASE\=)(.+)/', '${1}' . $this->config->database->name, $output );
			$output = preg_replace( '/(DB_CHARSET\=)(.+)/', '${1}' . $this->config->database->charset, $output );
			$output = preg_replace( '/(DB_HOST\=)(.+)/', '${1}' . $this->config->database->host, $output );

			// Set secret salts in config.php (https://api.wordpress.org/secret-key/1.1/salt/)
			$salt   = $this->getRandomKey($this->laravel['config']['app.cipher']);
			$output = preg_replace( '/(APP_KEY\=)(SomeRandomKey.+)/', '${1}' . $salt, $output );

			// Write dotenv config file
			echo "Write \"{$this->lumen_dir}/.env\" file.\n";
			$this->filesystem->put( "{$this->lumen_dir}/.env", $output );
			unset( $output );
		}
	}

	/**
	 * Generate a random key for the application.
	 *
	 * @param  string  $cipher
	 * @return string
	 */
	protected function getRandomKey($cipher)
	{
		if ($cipher === 'AES-128-CBC') {
			return Str::random(16);
		}

		return Str::random(32);
	}
}