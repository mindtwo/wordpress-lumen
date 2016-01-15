<?php

/**
 * Define constants
 */
define('THEME_APPLICATION_DIR', realpath( ABSPATH . '/../../') . '/');
define('THEME_DIR', realpath(get_template_directory()) . '/');
define('THEME_FUNCTIONS', THEME_DIR . 'functions/');
define('THEME_CONFIG', THEME_DIR . 'config/');
define('THEME_TEMPLATES', THEME_DIR . 'templates/');
define('THEME_ASSETS', THEME_DIR . 'assets/');
define('THEME_ASSETS_LIVE', get_bloginfo('template_directory') . '/assets/');
define('THEME_STORAGE', realpath(THEME_APPLICATION_DIR) . 'lumen/storage/wordpress/');
define('TEMPLATE_DIR', realpath(THEME_APPLICATION_DIR . 'resources/views/'));


/**
 * Set files to be autoloaded
 */
$required_files = array(
    THEME_FUNCTIONS . 'general/lumen.php',
    THEME_FUNCTIONS . 'general/translator.php',
    THEME_FUNCTIONS . 'general/acf.php',
    // THEME_FUNCTIONS . 'general/dashboard_widgets.php',
    THEME_FUNCTIONS . 'helper/theme_helper.php',
    THEME_FUNCTIONS . 'helper/multisite.php',
    THEME_FUNCTIONS . 'helper/timber_global.php',
);


/**
 * Autoload class files
 */
foreach($required_files as $file){
	if(file_exists($file)) {
		include($file);
	}
}


/**
 * Register theme classes
 */
$detect = new \Jenssegers\Agent\Agent();
$shortcodes = new \WpTheme\Shortcodes\ShortcodesRegister();
$cpt = new \WpTheme\PostTypes\CustomPostTypeRegister();
$widgets = new \WpTheme\Widgets\WidgetsRegister();
$modules = new \WpTheme\Modules\ModulesRegister();


/**
 * Add Timber template pathes
 */
if (class_exists('Timber')) {
    Timber::$locations = TEMPLATE_DIR;
    Timber::$dirname   = TEMPLATE_DIR;
}