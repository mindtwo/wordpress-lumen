<?php

/**
 * Set current language based on HTTP_HOST
 */
if (! function_exists('set_local_in_http_env')) {
	function set_local_in_http_env() {
		if(in_array($_SERVER['HTTP_HOST'], ['domain.de.local', 'domain.de'])) {
			app('translator')->setLocale('de');
		} else if(in_array($_SERVER['HTTP_HOST'], ['domain.at.local', 'domain.at'])) {
			app('translator')->setLocale('de-AT');
			app('translator')->setFallback('de');
		}
	}
}

if (! function_exists('is_wordpress')) {
	function is_wordpress() {
		if(defined('ABSPATH')) {
			return true;
		}
		return false;
	}
}

if (! function_exists('trans')) {
	/**
	 * Translate the given message.
	 *
	 * @param  string  $id
	 * @param  array   $parameters
	 * @param  string  $domain
	 * @param  string  $locale
	 * @return string
	 */
	function trans($id = null, $parameters = [], $domain = 'messages', $locale = null)
	{
		if (is_null($id)) {
			return app('translator');
		}

		return app('translator')->trans($id, $parameters, $domain, $locale);
	}
}

if (! function_exists('hasTrans')) {
	/**
	 * Translate the given message.
	 *
	 * @param  string  $id
	 * @param  array   $parameters
	 * @param  string  $domain
	 * @param  string  $locale
	 * @return string
	 */
	function hasTrans($id = null)
	{
		if (is_null($id)) {
			return app('translator');
		}

		return app('translator')->has($id);
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
			$file_path_local = base_path('../public/rev-manifest-dev.json');
			if(app( "files" )->exists( $file_path_local )) {
				$manifest = json_decode(file_get_contents($file), true);
			}
		}

		if (is_null($manifest)) {
			$manifest = json_decode(file_get_contents(base_path('../public/rev-manifest.json')), true);
		}

		if (isset($manifest[$file])) {
			return '/'.$manifest[$file];
		}

		throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
	}
}

if (! function_exists('get_wordpress_url')) {
	function get_wordpress_url(  ) {
		$lumen_public_path = '/api';
		return str_replace($lumen_public_path, '/', url('/'));
	}
}

if (! function_exists('encode_all_htmlentities')) {
	function encode_all_htmlentities($str) {
		$str = mb_convert_encoding($str , 'UTF-32', 'UTF-8');
		$t = unpack("N*", $str);
		$t = array_map(function($n) { return "&#$n;"; }, $t);
		return implode("", $t);
	}
}

/**
 * Creates a custom random string
 *
 * @param int    $length
 * @param string $type
 *
 * @return string
 */
if (! function_exists('random_key')) {
	function random_key($length=5,$type='both')
	{
		$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		$numbers = "0123456789";
		$special_chars = "``-=~!@#$%^&*()_+,./<>?;:[]{}\|";
		switch($type) {
			case "special_chars":
				$chars = $letters . $numbers . $special_chars;
				break;
			case "letters":
				$chars = $letters;
				break;
			case "numbers":
				$chars = $numbers;
				break;
			default:
				$chars = $letters . $numbers;
		}

		$string = '';
		$max = strlen($chars) - 1;
		for($i=0; $i < $length; $i++) {
			$string .= $chars[rand(0, $max)];
		}

		return $string;
	}
}

/**
 * Creates a transaction id
 *
 * @access public
 *
 * @param string $style
 * @param string $prefix
 *
 * @return string
 */
if (! function_exists('transaction_id')) {
	function transaction_id($style='default', $prefix='-') {

		switch($style) {
			case "short":
				$token = date('y-z-G-i-s') . '.' . rand(1000,9999);
				break;
			case "date":
				$token = date('Y-m-d');
				break;
			case "date_time":
				$token = date('Y-m-d-G-i-s');
				break;
			case "long":
				$token = date('Y-m-d-G-i-s') . '-' . uniqid();
				break;
			case "date_time_long":
				$token = date('Ymd-Gis') . '-' . rand(100,999);
				break;
			default:
				$token = date('y-z-G-i-s') . '-' . uniqid();
		}

		return $token . $prefix;
	}
}

/**
 * Create a slug save string
 * @param      $str
 * @param null $lang
 *
 * @return mixed|string
 */
if (! function_exists('slug_safe_string')) {
	function slug_safe_string($str,$lang=NULL) {
		$umlaute = array("ä","ö","ü","Ü","Ä","Ö","ß","&Auml;","&Ouml;","&Uuml","&auml","&ouml;","&uuml;","§");
		$keineuml = array("ae","oe","ue","Ue","Ae","Oe","ss","Ae","Oe","Ue","ae","oe","ue","");

		if(is_null($lang) && $lang == 'de') {
			array_push($umlaute, "&amp;", "&");
			array_push($keineuml, " und ", " und ");
		} else {
			array_push($umlaute, "&amp;", "&");
			array_push($keineuml, " and ", " and ");
		}

		$str = str_replace($umlaute, $keineuml, $str);
		$str = iconv("UTF-8", "ASCII//TRANSLIT", $str);
		$str = preg_replace("/[^a-zA-Z0-9_-]/", '-', $str);
		$str = preg_replace("/[\/_|+ -]+/", '-', $str);
		$str = strtolower(trim($str, '-'));

		return $str;
	}

}