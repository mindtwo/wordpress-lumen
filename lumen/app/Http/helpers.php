<?php

/**
 * Set current language based on HTTP_HOST
 */
if (! function_exists('setLocalInHttpEnv')) {
	function setLocalInHttpEnv() {
		if(in_array($_SERVER['HTTP_HOST'], ['jonasemde.de.local', 'jonasemde.de'])) {
			app('translator')->setLocale('de');
		} else if(in_array($_SERVER['HTTP_HOST'], ['jonasemde.at.local', 'jonasemde.at'])) {
			app('translator')->setLocale('de-AT');
			app('translator')->setFallback('de');
		}
	}
}

if (! function_exists('elixir')) {
	/**
	 * Get the path to a versioned Elixir file.
	 *
	 * @param  string  $file
	 * @return string
	 *
	 * @throws \InvalidArgumentException
	 */
	function elixir($file)
	{
		static $manifest = null;

		if(env('APP_ENV') == 'local') {
			$manifest = json_decode(file_get_contents(base_path('/public/rev-manifest-local.json')), true);
		}

		if (is_null($manifest)) {
			$manifest = json_decode(file_get_contents(base_path('/public/rev-manifest.json')), true);
		}

		if (isset($manifest[$file])) {
			return '/'.$manifest[$file];
		}

		throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
	}
}

if (! function_exists('get_wordpress_url')) {
	function get_wordpress_url(  ) {
		$lumen_public_path = '/l';
		return str_replace($lumen_public_path, '/', url('/'));
	}
}
