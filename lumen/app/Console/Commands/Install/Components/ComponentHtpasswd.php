<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentHtpasswd
 */
class ComponentHtpasswd extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( ! $this->filesystem->exists( $this->home_dir . '/.htpasswd' ) && isset( $this->config->basicauth->status ) && $this->config->basicauth->status == true ) {
			foreach ( $this->config->basicauth->users as $key => $value ) {
				$htpasswd_output_content[ $key ] = $key . ':' . $value;
			}

			$this->filesystem->put( "{$this->home_dir}/.htpasswd", implode( "\n", $htpasswd_output_content ) );
		}
	}
}