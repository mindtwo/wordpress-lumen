<?php

namespace App;

use Laravel\Lumen\Application;

class DomainApplication extends Application {

	public function getLanguagePath() {
		return realpath( base_path() . '/../resources/lang/' );
	}
}