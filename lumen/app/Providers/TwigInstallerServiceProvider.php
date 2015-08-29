<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TwigInstallerServiceProvider extends ServiceProvider {

	private $template_dir;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->template_dir = realpath(base_path() . '/../install/views');

		$this->app->singleton( 'TwigInstaller', function ($app) {
			\Twig_Autoloader::register();
			$loader = new \Twig_Loader_Filesystem($this->template_dir.'/');
			return new \Twig_Environment($loader, array('cache' => false ));
		});
	}
}