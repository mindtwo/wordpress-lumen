<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class TwigServiceProvider extends ServiceProvider {

	private $template_dir;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		$this->template_dir = realpath(base_path() . '/../resources/views');

		$this->app->singleton( 'Twig', function ($app) {
			\Twig_Autoloader::register();
			$loader = new \Twig_Loader_Filesystem($this->template_dir.'/');
			return new \Twig_Environment($loader, array('cache' => false ));
		});
	}
}