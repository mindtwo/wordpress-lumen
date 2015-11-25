<?php

/**
 * Define constants
 */
define('THEME_APPLICATION_DIR', realpath(ABSPATH . '/../../') . '/');
define('THEME_DIR', realpath(get_template_directory()) . '/');
define('THEME_FUNCTIONS', THEME_DIR . 'functions/');
define('THEME_CONFIG', THEME_DIR . 'config/');
define('THEME_WIDGETS', THEME_DIR . 'widgets/');
define('THEME_INCLUDES', THEME_DIR . 'includes/');
define('THEME_MODULES', THEME_DIR . 'modules/');
define('THEME_TEMPLATES', THEME_DIR . 'templates/');
define('THEME_ASSETS', THEME_DIR . 'assets/');
define('THEME_ASSETS_LIVE', get_bloginfo('template_directory') . '/assets/');
define('THEME_STORAGE', realpath(THEME_APPLICATION_DIR) . 'lumen/storage/wordpress/');
define('TEMPLATE_DIR', realpath(THEME_APPLICATION_DIR . 'resources/views/'));


/**
 * Load Lumen application
 */
$app = require THEME_APPLICATION_DIR.'/lumen/bootstrap/app.php';


/**
 * Set files to be autoloaded
 */
$autoload_class_files = array(
    // THEME_FUNCTIONS . 'general/minify_html.php',
    // THEME_FUNCTIONS . 'general/debug.php',
    // THEME_FUNCTIONS . 'general/dashboard_widgets.php',
    // THEME_FUNCTIONS . 'general/capabilities.php',
    THEME_FUNCTIONS . 'general/walker_bootstrap.php',
    THEME_FUNCTIONS . 'general/theme_helper.php',
    THEME_FUNCTIONS . 'general/custom_excerpt.php',
    THEME_FUNCTIONS . 'general/cleanup_backend.php',
    THEME_FUNCTIONS . 'general/cleanup_frontend.php',
    THEME_FUNCTIONS . 'general/shortcode_helper.php',
    THEME_FUNCTIONS . 'general/timber_global.php',
    THEME_FUNCTIONS . 'general/acf.php',
    THEME_FUNCTIONS . 'site/sidebar.php',
    THEME_FUNCTIONS . 'site/image-sizes.php',
    THEME_FUNCTIONS . 'site/multisite.php',
    THEME_FUNCTIONS . 'site/navigation.php',
    THEME_MODULES . 'ModuleController.php',
    THEME_MODULES . 'AjaxActionsModule.php',
    THEME_MODULES . 'PostsModule.php',
    THEME_MODULES . 'ShortcodesModule.php',
    THEME_MODULES . 'ShortcodesBootstrapModule.php',
    THEME_MODULES . 'ConversionModule.php',
    THEME_MODULES . 'TeamModule.php',
    THEME_MODULES . 'JobModule.php',
    THEME_MODULES . 'TestimonialModule.php',
    THEME_MODULES . 'FaqModule.php',
    THEME_MODULES . 'LexiconModule.php',
	THEME_WIDGETS . 'search-box.php',
	THEME_WIDGETS . '_widget_init.php', // Must loaded after widget import
);


/**
 * Autoload class files
 */
foreach($autoload_class_files as $file){
	require_once($file);
}


/**
 * Add Timber template pathes
 */
if (class_exists('Timber')) {
    Timber::$locations = TEMPLATE_DIR;
    Timber::$dirname   = TEMPLATE_DIR;
}


/**
 * Load global theme classes
 */
$detect = new \Jenssegers\Agent\Agent();
$helper = new \cg\Helper\HelperBuilder();


/**
 * Enable meta logging
 */
$helper->meta()->writeClickStreamToSession();