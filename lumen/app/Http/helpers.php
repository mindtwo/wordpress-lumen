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
			// $manifest = json_decode(file_get_contents(base_path('../public/rev-manifest-local.json')), true);
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

/**
 * @param null $basepath
 * @param null $filename
 *
 * @return mixed
 */
if (! function_exists('write_meta_log_file')) {
	function write_meta_log_file($basepath=NULL, $filename=NULL)
	{
		$result['_DATETIME'] = date('Y-m-d H:i:s');
		if(isset($_SERVER)) {
			$whitelist_server_keys = array('SCRIPT_FILENAME', 'REMOTE_ADDR', 'REMOTE_PORT', 'SERVER_ADDR', 'SERVER_PORT', 'REQUEST_URI', 'HTTP_HOST', 'HTTP_ACCEPT_LANGUAGE', 'HTTP_USER_AGENT', 'REQUEST_TIME_FLOAT', 'HTTP_REFERER', 'HTTP_CONTENT_LENGTH');
			foreach($whitelist_server_keys as $key) {
				$result['_SERVER'][$key] = (isset($_SERVER[$key]) ? $_SERVER[$key] : '');
			}
		}

		if(isset($_REQUEST)) {
			$result['_REQUEST'] = $_REQUEST;
		}

		if(isset($_COOKIE)) {
			$result['_COOKIE'] = $_COOKIE;
		}

		if(isset($_SESSION)) {
			$result['_SESSION'] = session()->all();
		}

		$result = json_encode($result, JSON_PRETTY_PRINT);

		if (is_dir($basepath)){
			$fp = fopen($basepath . $filename, 'w');
			fwrite($fp, $result);
			fclose($fp);
			return true;
		} else {
			return false;
		}
	}
}


/**
 * Clickstream to session
 *
 * @access private
 * @return string
 */
if (! function_exists('write_clickstream_to_session')) {
	function write_clickstream_to_session() {
		if(isset($_SERVER)) {
			$data['_DATETIME'] = date('Y-m-d H:i:s');

			if(isset($_GET)) {
				$data['_GET'] = $_GET;
			}

			$whitelist_server_keys = array('HTTP_REFERER', 'REQUEST_URI', 'HTTP_HOST','REDIRECT_STATUS');
			foreach($whitelist_server_keys as $key) {
				$data[$key] = (isset($_SERVER[$key]) ? $_SERVER[$key] : '');
			}
		}

		$data['DATETIME'] = date('Y-m-d H:i:s');

		if(session()->get('_CLICKSTREAM') == NULL) {
			session()->put('_CLICKSTREAM', [$data]);
		} else {
			session()->push('_CLICKSTREAM', $data);
		}
		session()->save();
		var_dump(session()->get('_CLICKSTREAM'));
	}
}