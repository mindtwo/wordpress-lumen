<?php

namespace App\Console\Commands\Install\Components;


interface WpInstallComponentsInterface {

	/**
	 * Fire component task
	 *
	 * @return NULL
	 */
	public function fire();
}