<?php

namespace App;

use Laravel\Lumen\Application;
use Illuminate\Contracts\Foundation\Application as ApplicationInterface;

class DomainApplication extends Application {

	public function getLanguagePath() {
		return realpath( base_path() . '/../resources/lang/' );
	}
}